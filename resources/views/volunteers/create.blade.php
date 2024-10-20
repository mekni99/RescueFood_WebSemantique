<div class="font-[sans-serif] relative">
    <div class="h-[240px] font-[sans-serif]">
        <img src="https://readymadeui.com/cardImg.webp" alt="Banner Image" class="w-full h-full object-cover" />
    </div>

    <div class="relative -mt-40 m-4">
        <form action="{{ route('volunteers.store') }}" method="POST" class="bg-white max-w-xl w-full mx-auto shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] p-8 rounded-2xl">
            @csrf
            <div class="mb-12">
                <h3 class="text-gray-800 text-3xl font-bold text-center">Add Volunteer</h3>
            </div>

            <!-- Full Name -->
            <div>
                <label class="text-gray-800 text-xs block mb-2">Full Name</label>
                <div class="relative flex items-center">
                    <input name="name" type="text" required class="w-full bg-transparent text-sm text-gray-800 border-b border-gray-300 focus:border-blue-500 px-2 py-3 outline-none" placeholder="Enter name" />
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-[18px] h-[18px] absolute right-2" viewBox="0 0 24 24">
                        <circle cx="10" cy="7" r="6"></circle>
                        <path d="M14 15H6a5 5 0 0 0-5 5 3 3 0 0 0 3 3h12a3 3 0 0 0 3-3 5 5 0 0 0-5-5zm8-4h-2.59l.3-.29a1 1 0 0 0-1.42-1.42l-2 2a1 1 0 0 0 0 1.42l2 2a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42l-.3-.29H22a1 1 0 0 0 0-2z"></path>
                    </svg>
                </div>
            </div>

            <!-- Location -->
            <div class="mt-8">
                <label class="text-gray-800 text-xs block mb-2">Location</label>
                <div class="relative flex items-center">
                    <input name="location" type="text" required class="w-full bg-transparent text-sm text-gray-800 border-b border-gray-300 focus:border-blue-500 px-2 py-3 outline-none" placeholder="Enter location" />
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-[18px] h-[18px] absolute right-2"></svg>
                </div>
            </div>

            <!-- Availability -->
            <div class="mt-8">
                <label class="text-gray-800 text-xs block mb-2">Availability</label>
                <div class="relative flex items-center">
                    <input name="availability" type="text" required class="w-full bg-transparent text-sm text-gray-800 border-b border-gray-300 focus:border-blue-500 px-2 py-3 outline-none" placeholder="Enter availability" />
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-[18px] h-[18px] absolute right-2"></svg>
                </div>
            </div>

            <!-- Telephone Number -->
            <div class="mt-8">
                <label class="text-gray-800 text-xs block mb-2">Telephone Number</label>
                <div class="relative flex items-center">
                    <input name="telephone_number" type="text" required class="w-full bg-transparent text-sm text-gray-800 border-b border-gray-300 focus:border-blue-500 px-2 py-3 outline-none" placeholder="Enter telephone number" />
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-[18px] h-[18px] absolute right-2"></svg>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-8">
                <button type="submit" class="w-full shadow-xl py-2.5 px-5 text-sm font-semibold tracking-wider rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none transition-all">
                    Register Volunteer
                </button>
            </div>
        </form>
    </div>
</div>
