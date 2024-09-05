<div>
    <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <a href="#">
            <img class="p-8 rounded-t-lg" src="storage/{{$item['avatar']??null}}" alt=""/>
        </a>
        <div class="px-5 pb-5">
            <a href="#">
                <h5 class="text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">{{$item['name']??null}}</h5>
            </a>
            <div class="flex items-center mt-2.5 mb-5">
                <div class="flex items-center space-x-1 rtl:space-x-reverse">
                    <h4 class="text-lg font-semibold tracking-tight text-gray-900 dark:text-white">{{implode(',',$item['subjects'])??null}}</h4>
                </div>

            </div>
            <div class="flex items-center justify-between">
                <span class="text-3xl font-bold text-gray-900 dark:text-white">${{$item['hourly_rate']}}/hour</span>
                <a href="#" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add to cart</a>
            </div>
        </div>
    </div>
</div>
