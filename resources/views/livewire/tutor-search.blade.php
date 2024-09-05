<div class="max-w-screen-xl mx-auto row">
    <div class="max-w-lg mx-auto">
        <div class="flex">
            <button id="dropdownCheckboxButton" data-dropdown-toggle="dropdownDefaultCheckbox"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button">Subjects&nbsp;<svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="m1 1 4 4 4-4"/>
                </svg>
            </button>

            <!-- Dropdown menu -->
            <div id="dropdownDefaultCheckbox"
                 class="z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600">
                <ul class="p-3 space-y-3 text-sm text-gray-700 dark:text-gray-200"
                    aria-labelledby="dropdownCheckboxButton">
                    @foreach($subjectOptions as $key=>$option)
                        <li>
                            <div class="flex items-center">
                                <input id="checkbox-item-{{$key}}" type="checkbox" wire:model="subjects"
                                       value="{{$option}}"
                                       class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="checkbox-item-{{$key}}"
                                       class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">&nbsp;{{$option}}</label>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="relative w-full">
                <input type="searchText" wire:model="searchText" id="search-dropdown" wire:keydown.enter="search"
                       class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
                       placeholder="Search Tutors" required/>
                <button wire:click="search"
                        class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                    <span class="sr-only">Search</span>
                </button>
            </div>
        </div>
        <div class="relative mb-6">
            <label for="labels-range-input" class="sr-only">Labels range</label>
            <input id="labels-range-input" wire:model="hourlyRate" type="range" value="" min="0"
                   max="{{$maxHourlyRate}}"
                   class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
                   oninput="updateRangeValue()">
            <br>
            <span class="text-sm text-gray-500 dark:text-gray-400 absolute start-0 -bottom-6">Min ($0)</span>
            <span class="text-sm text-gray-500 dark:text-gray-400">
            Selected: <span id="rangeValue">{{$hourlyRate}}</span>
        </span>
            <span
                class="text-sm text-gray-500 dark:text-gray-400 absolute end-0 -bottom-6">Max (${{$maxHourlyRate}})</span>
        </div>
    </div>
    @if(!empty($result))
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
        @foreach($result as $item)
                @livewire('tutor-search-detail', ['item'=>$item , key($item['id'])])
        @endforeach
        </div>

    @endif
</div>

<script>
    function updateRangeValue() {
        // Get the value from the range input
        var rangeValue = document.getElementById('labels-range-input').value;
        // Update the span with the new value
        document.getElementById('rangeValue').innerText = rangeValue;
    }

    // Initialize the display on page load
    window.onload = function() {
        updateRangeValue();
    };
</script>
