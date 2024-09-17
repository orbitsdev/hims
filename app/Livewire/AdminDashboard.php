<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Semester;
use App\Models\Condition;
use App\Models\AcademicYear;

class AdminDashboard extends Component
{

    public $academicYears = [];
    public $semesters = [];
    public $selectedAcademicYear = null;
    public $selectedSemester = null;
    public $data = [];
    public $conditions = [];



    public function mount()
    {
        // Fetch all academic years for the dropdown
        $this->academicYears = AcademicYear::all();

        // Optionally set the default academic year (current one)
        $this->selectedAcademicYear = $this->academicYears->first()->id ?? null;

        // Fetch semesters for the selected academic year
        $this->fetchSemesters();

        // Fetch chart data based on the initial selections
        $this->fetchChartData();
    }

    public function fetchSemesters()
    {
        if ($this->selectedAcademicYear) {
            $this->semesters = Semester::where('academic_year_id', $this->selectedAcademicYear)->get();
            $this->selectedSemester = $this->semesters->first()->id ?? null;


        }
    }

    // Method to fetch chart data based on the selected academic year and semester
    public function fetchChartData()
    {
        if ($this->selectedAcademicYear && $this->selectedSemester) {

            // Fetch the top 5 conditions for the selected academic year and semester
            $this->conditions = Condition::whereHas('medicalRecords', function ($query) {
                $query->whereHas('record', function ($query) {
                    $query->where('academic_year_id', $this->selectedAcademicYear)
                          ->where('semester_id', $this->selectedSemester);
                });
            })
            ->withCount('medicalRecords')
            ->orderBy('medical_records_count', 'desc')
            ->limit(5)
            ->get();

            // Format the data for Chart.js
            $this->data = [
                'labels' => $this->conditions->pluck('name')->toArray(),
                'datasets' => [
                    [
                        'label' => 'Medical Records per Condition',
                        'backgroundColor' => 'rgba(75, 192, 192, 0.6)',
                        'borderColor' => 'rgba(75, 192, 192, 1)',
                        'borderWidth' => 1,
                        'data' => $this->conditions->pluck('medical_records_count')->toArray(),
                    ]
                ]
            ];



        }
    }

    // Updated the chart when academic year changes

    public function updatedSelectedAcademicYear($value)
    {

        $this->fetchSemesters(); // Fetch semesters when the academic year changes
        $this->fetchChartData();  // Fetch chart data based on the new selections
    }

    // Update the chart when semester changes
    public function updatedSelectedSemester($value)
    {

        $this->fetchChartData(); // Fetch chart data when the semester changes
    }


    public function render()
    {
        return view('livewire.admin-dashboard');
    }
}
