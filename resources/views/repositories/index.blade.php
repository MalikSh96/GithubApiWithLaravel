@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg font-medium">
            <h3>Data collected from Github API</h3>
        </div>
    </div>  
    <div class="flex justify-center">
        <table class="mx-auto max-w-4xl w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden">
            <thead class="bg-gray-900">
                <tr class="text-white text-left">
                    <th>Owner</th>
                    <th>Project Name</th>
                    <th>Path</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($datas as $data)
                <tr>
                    <td class="px-6 py-4 font-medium">
                        {{ $username }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $data['name'] }}
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ $data['html_url'] }}" class="text-blue-600">
                            Link to Github Repository
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

<!-- @ symbols and the keywords are laravels blade directives -->