<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Espace ecrivain') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <h2 class="text-lg font-medium text-gray-900 mb-6">
                {{ __('Mes articles') }}
            </h2>
            @if(auth()->user()->is_writer)
                <div class="max-w-xl">
                    <a class="action-link" href="{{route('article.index')}}">Voir mes articles</a>
                </div>
                <div class="max-w-xl">
                        <a class="action-link" href="{{route('article.create')}}">Rediger un article</a>
                    </div>  
            @elseif(auth()->user()->submission)
                <p class="is-empty-msg">Votre demande est entrain d'etre traite</p>
            @else      
                <p class="is-empty-msg">Votre statut d'ecrivain  a été suspendu</p> 
                <a class="action-link" href="{{route('article.index')}}">Voir mes articles</a>
            @endif
            </div>


            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!--<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>-->
        </div>
    </div>
</x-app-layout>
