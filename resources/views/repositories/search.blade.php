@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg font-medium">
            Look up repositories for a Github User through the Github API or our database
        </div>
    </div>
    <div class="flex justify-center">
        <form action="{{ route('search') }}" method="post" class="mb-4" >
            @csrf
            <div class="mb-4">
                <p>Enter username</p>
                <label for="username" class="sr-only">Username</label>
                <input type="text" name="username" id="username" placeholder="Username" 
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg  
                    @error('username') border-red-500 @enderror" value="{{ old('username') }}"
                >
                @error('username')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }} <!--scoped message variable-->
                    </div>
                @enderror
            </div>
            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">
                    Get Repositories
                </button>
            </div>
        </form>
    </div>
@endsection

<!-- @ symbols and the keywords are laravels blade directives -->