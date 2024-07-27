<x-admin-layout>
    <div class="flex  justify-end px-4">
        <x-filament::button  class=""   href="{{route('conditions')}}"
        tag="a" icon="heroicon-m-arrow-left" color="gray">
            <span class="text-sm text-gray-400"> BACK</span>
        </x-filament::button>
    
    </div>
    <div class="p-4">
        <div class="grid grid-cols-12 gap-x-8">
            <form wire:submit="save" class="col-span-6">
                {{ $this->form }}
                <x-filament::button type="submit" class="mt-4">
                    UPDATE
                </x-filament::button>
            </form>
            {{-- <div class="col-span-6 ">
                
                @livewire('conditions.condtion-treatment-lists', ['record' => $record])
                
            </div> --}}
           
            <div class="col-span-6 ">
                <div class="px-4 sm:px-6 lg:px-8 bg-white py-6 rounded-lg">
                    <div class="sm:flex sm:items-center ">
                      <div class="sm:flex-auto">
                        <h1 class="text-base font-semibold leading-6 text-gray-900">TREATMENTS</h1>
                       
                      </div>
                      <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                        {{-- <button type="button" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add user</button> --}}
                        {{ ($this->createTreatmentAction)}}
                      </div>
                    </div>
                    <div class=" flow-root">
                      <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                          <table class="min-w-full divide-y divide-gray-300">
                            <thead>
                              <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Name</th>
                                
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                  <span class="sr-only">Edit</span>
                                </th>
                              </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($record->treatments as  $treatment)
                                    
                              
                              <tr>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">{{$treatment->name}}</td>
                                
                                <td class="relative whitespace-nowrap py-4  text-right text-sm font-medium sm:pr-0 flex items-center justify-end">
                                    <div class="mr-3">
                                        {{($this->viewTreatmentAction)(['record'=> $treatment->id])}}
                                        
                                    </div>
                                    <div class="mr-3">
                                        {{($this->editTreatmentAction)(['record'=> $treatment->id])}}
                                        
                                    </div>
                                        <div class="">
                                        {{($this->deleteTreatmentAction)(['record'=> $treatment->id])}}

                                    </div>
                                 
                                </td>
                              </tr>
                              @endforeach
                  
                              <!-- More people... -->
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="border-t text-center text-sm  py-4  sm:pr-0 text-blue-600">
                      <a href="{{route('condition-treatments-lists', ['record'=> $record] )}}">VIEW ALL TREATMENTS</a> 
                      </div>
                  </div>
                  
            </div>
        </div>
        
        
        
        
        <x-filament-actions::modals />

        
        
        {{-- <div class="relative  bg-white py-6 px-8 rounded  mt-6  " id="ps">
            <div class="">
                <h1 class="pb-4 pl-4 pr-4 text-lg text-gray-700"> Treatments</h1>            
            </div> --}}
        </div>
        
    </x-admin-layout>