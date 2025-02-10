<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Staff;
use App\Models\Student;
use App\Models\Personnel;
use App\Models\MedicalRecord;
use App\Models\PersonalDetail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    const ADMIN = 'Admin';
    const STAFF = 'Staff';
    const PERSONNEL = 'Personnel';
    const STUDENT = 'Student';

    const ROLES = [
        //   User::ADMIN => User::ADMIN,
        User::STAFF => User::STAFF,
        User::PERSONNEL => User::PERSONNEL,
        User::STUDENT => User::STUDENT,
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'profile_photo_path',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function fullName()
    {
        return $this->name;
    }
    public function fullNameWithEmail()
    {
        return ($this->name ?? '') . ' (' . ($this->email ?? '') . ')';
    }
    public function fullNameWithEmailAndRole()
    {
        return '( '.($this->role ?? '').') '. ($this->name ?? '');
    }

    // public function checkIfHasAccount(){
    //     switch ($this->role) {
    //         case User::STUDENT:

    //         default:
    //           return redirect()->route('unauthorizepage');
    //     }

    // }

    public function dashBoardBaseOnRole()
    {
        switch ($this->role) {
            case User::ADMIN:
                 return redirect()->route('admin-dashboard');
            case User::STUDENT:
                if ($this->student()->exists()) {
                    return redirect()->route('events.index');
                } else {
                    return redirect()->route('fill.student-form');
                }

            case User::PERSONNEL:
                if ($this->personnel()->exists()) {
                    return redirect()->route('events.index');
                } else {
                    return redirect()->route('fill.personnel-form');
                }
            case User::STAFF:
                return redirect()->route('admin-dashboard');
            default:
                return redirect()->route('unauthorizepage');
        }
    }
    public function routeBaseOnRole()
    {
        switch ($this->role) {
            case User::ADMIN:
                return route('admin-dashboard');
            case User::STUDENT:
                return route('events.index');
            case User::PERSONNEL:
                return route('events.index');
            case User::STAFF:
                return route('admin-dashboard');
            default:
                return route('unauthorizepage');
        }
    }

    public function getImage()
    {
        if (!empty($this->profile_photo_path) && Storage::disk('public')->exists($this->profile_photo_path)) {
            return Storage::disk('public')->url($this->profile_photo_path);
        } else {
            return asset('images/placeholder-image.jpg'); // Return default image URL
        }
    }

    public function scopeNotAdmin($query)
    {
        return $query->where('role', '!=', User::ADMIN);
    }
    public function scopeNotStudent($query)
    {
        return $query->where('role', '!=', User::STUDENT);
    }
    public function scopeNotPersonnel($query)
    {
        return $query->where('role', '!=', User::PERSONNEL);
    }
    public function scopeNotStaff($query)
    {
        return $query->where('role', '!=', User::STAFF);
    }
    public function scopeNotRegisteredStudents($query)
    {
        return $query->where('role', User::STUDENT)->whereDoesntHave('student');
    }
    public function scopeNotRegisteredStaff($query)
    {
        return $query->where('role', User::STAFF)->whereDoesntHave('staff');
    }
    public function scopeNotRegisteredPersonnel($query)
    {
        return $query->where('role', User::PERSONNEL)->whereDoesntHave('personnel');
    }

    public function scopeHasPersonalDetails($query)
    {

        return $query->whereHas('student.personalDetail')
            ->orWhereHas('staff.personalDetail')
            ->orWhereHas('personnel.personalDetail');
    }

    public function personalDetail(): MorphOne
    {
        return $this->morphOne(PersonalDetail::class, 'personaldetailable');
    }

    public function student()
    {
        return $this->hasOne(Student::class);
    }
    public function staff()
    {
        return $this->hasOne(Staff::class);
    }

    public function personnel()
    {
        return $this->hasOne(Personnel::class);
    }

    public function scopeRoleAndDepartment($query, $role, $department)
    {
        switch ($role) {
            case self::STUDENT:
                return $query->whereHas('student', function ($query) use ($department) {
                    $query->where('department_id', $department);
                });
            case self::STAFF:
                return $query->whereHas('staff', function ($query) use ($department) {
                    $query->where('department_id', $department);
                });
            case self::PERSONNEL:
                return $query->whereHas('personnel', function ($query) use ($department) {
                    $query->where('department_id', $department);
                });
            default:
                return $query; // Return the query object to allow further chaining
        }
    }
    public function scopePersonalDetailsSearch($query, $search)
    {

        return $query->whereHas('student.personalDetail', function ($q) use ($search) {
            $q->where('first_name', 'like', "%{$search}%");
        })->orWhereHas('staff.personalDetail', function ($q) use ($search) {
            $q->where('first_name', 'like', "%{$search}%");
        })->orWhereHas('personnel.personalDetail', function ($q) use ($search) {
            $q->where('first_name', 'like', "%{$search}%");
        });
    }

    public function getPersonalDetailsBaseOnRole()
    {
        switch ($this->role) {
            case User::STUDENT:
                return $this->student ? $this->student->personalDetail : null;
            case User::STAFF:
                return $this->staff ? $this->staff->personalDetail : null;
            case User::PERSONNEL:
                return $this->personnel ? $this->personnel->personalDetail : null;
            case User::ADMIN:
                return null;
            default:
                return null;
        }
    }
    public function getDepartmentBaseOnRole()
    {
        switch ($this->role) {
            case User::STUDENT:
                return $this->student ? $this->student->department : null;
            case User::STAFF:
                return $this->staff ? $this->staff->department : null;
            case User::PERSONNEL:
                return $this->personnel ? $this->personnel->department : null;
            case User::ADMIN:
                return null;
            default:
                return null;
        }
    }
    public function displayPersonalDetailsBaseOnRole()
    {
        switch ($this->role) {
            case User::STUDENT:
                return $this->student ? $this->student->personalDetail : null;
            case User::STAFF:
                return $this->staff ? $this->staff->personalDetail : null;
            case User::PERSONNEL:
                return $this->personnel ? $this->personnel->personalDetail : null;
            case User::ADMIN:
                return null;
            default:
                return null;
        }
    }

    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }

    public function scopeHasAnyRoles($query, $roles)
    {
        $query->whereIn('role', $roles);
    }

    public function hasRoleOf($roles){
        return in_array($this->role, (array) $roles);
    }



    public function scopeNoRecordInThisAcademicYearAndSemester($query, $record)
    {
        return $query->whereDoesntHave('medicalRecords.record', function ($q) use ($record) {
            $q->where('id', $record->id)
                ->where('semester_id', $record->semester_id);
        });
    }

    // public function scopeDepartmentBelong($query, $departments)
    // {
    //     $query->where(function ($q) use ($departments) {
    //         $q->whereHas('student.department', function ($query) use ($departments) {
    //             $query->whereIn('id', $departments);
    //         })
    //             ->orWhereHas('staff.department', function ($query) use ($departments) {
    //                 $query->whereIn('id', $departments);
    //             })
    //             ->orWhereHas('personnel.department', function ($query) use ($departments) {
    //                 $query->whereIn('id', $departments);
    //             });
    //     });
    // }

    public function scopeDepartmentBelong($query, $departments)
{
    $query->where(function ($q) use ($departments) {
        $q->whereHas('student', function ($query) use ($departments) {
            $query->whereHas('department', function ($q) use ($departments) {
                $q->whereIn('id', $departments);
            })->whereHas('personalDetail', function ($q) {
                $q->whereNotNull('phone')->where('phone', '!=', '');
            });
        })
        ->orWhereHas('staff', function ($query) use ($departments) {
            $query->whereHas('department', function ($q) use ($departments) {
                $q->whereIn('id', $departments);
            })->whereHas('personalDetail', function ($q) {
                $q->whereNotNull('phone')->where('phone', '!=', '');
            });
        })
        ->orWhereHas('personnel', function ($query) use ($departments) {
            $query->whereHas('department', function ($q) use ($departments) {
                $q->whereIn('id', $departments);
            })->whereHas('personalDetail', function ($q) {
                $q->whereNotNull('phone')->where('phone', '!=', '');
            });
        });
    });
}


    public function scopeNoRecordInThisAcademicYearAndSemesterOnSpecificBatchDepartment($query, $record)
    {

        return $query->whereDoesntHave('medicalRecords', function ($query) use ($record) {
            $query->whereHas('recordBatch', function ($query) use ($record) {
                $query->where('id', $record->id)->where('department_id', $record->department_id);
            })->whereHas('record', function ($q) use ($record) {
                $q->where('id', $record->record->id)->where('semester_id', $record->record->semester->id);
            }
            );
        });
    }

    public function scopeNoRecordAcademicYearWithBatchDepartment($query, $batch)
    {

        // return $query->whereDoesntHave('medicalRecords', function ($query) use ($batch) {
        //     $query->whereHas('record', function ($q) use ($batch) {
        //         $q->where('id', $batch->record->id)
        //             ->where('semester_id', $batch->record->semester_id);
        //     })->whereHas('recordBatch', function($quer) use($batch){
        //         $quer->where('id', $batch->id)->where('department_id', $batch->department_id);
        //     });
        // })
        // ->where('role', $batch->department->role)->when($batch->department->role == User::STUDENT, function($query) use($batch){
        //     $query->whereHas('student', function ($q) use ($batch) {
        //         $q->where('section_id', $batch->section_id);
        //     });
        // });

        return $query->whereDoesntHave('medicalRecords', function ($query) use ($batch) {
            $query->whereHas('record', function ($q) use ($batch) {
                $q->where('id', $batch->record->id)
                    ->where('semester_id', $batch->record->semester_id);
            })->whereHas('recordBatch', function ($q) use ($batch) {
                $q->where('id', $batch->id)
                    ->where('department_id', $batch->department_id);
            });
        })
        ->where('role', $batch->department->role)
        ->when($batch->department->role == User::STUDENT, function ($query) use ($batch) {
            $query->whereHas('student', function ($q) use ($batch) {
                $q->where('section_id', $batch->section_id);
            });
        })
        ->where(function ($q) {
            $q->whereHas('student', function ($query) {
                $query->whereHas('personalDetail', function ($q) {
                    $q->whereNotNull('phone')->where('phone', '!=', '');
                });
            })
            ->orWhereHas('staff', function ($query) {
                $query->whereHas('personalDetail', function ($q) {
                    $q->whereNotNull('phone')->where('phone', '!=', '');
                });
            })
            ->orWhereHas('personnel', function ($query) {
                $query->whereHas('personalDetail', function ($q) {
                    $q->whereNotNull('phone')->where('phone', '!=', '');
                });
            })
            ->orWhereNotNull('phone'); // Also include users with phone numbers in the `users` table
        });


    }

    public function totalNotification()
    {
        return NotificationRequest::where('email', $this->email)->count();
    }
    public function getNotification()
    {
        return NotificationRequest::latest()->where('email', $this->email)->get();
    }

    public function scopeHasAccountOwner($query)
    {
    return $query->whereHas('student')->orWhereHas('personnel')->orWhereHas('staff');
    }



}
