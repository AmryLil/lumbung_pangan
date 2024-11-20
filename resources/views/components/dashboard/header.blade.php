<div class="w-full">
    <header class="w-[81%] left-64 top-0 flex fixed items-center justify-between p-4 bg-white shadow z-50">
        <div class="flex flex-col z-50">
            <h1 class="font-bold text-2xl text-slate-950">Dashboard</h1>
            <h3 class="font-light text-lg text-slate-700">main</h3>
        </div>
        <div class="flex items-center flex space-x-4">
            <label class="input input-bordered flex items-center gap-2 invisible">
                <input type="text" class="grow" placeholder="Search" />
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                    class="h-4 w-4 opacity-70">
                    <path fill-rule="evenodd"
                        d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                        clip-rule="evenodd" />
                </svg>
            </label>
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full">
                        <img alt="Tailwind CSS Navbar component"
                            src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                    </div>
                </div>

                <ul tabindex="0"
                    class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">

                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-left ">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </header>
</div>
