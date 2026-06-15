<x-app-layout>

<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden ">
            <div class="bg-white p-6 text-gray-900 mt-4 sm:rounded-lg shadow-sm">
                    <h3><b>Nom complet: </b>{{$submission->last_name}} {{$submission->first_name}}</h3>
                    <h4><b>Email de contact: </b>{{$submission->email}}</h4>
                    <h4><b>Experience: </b></h4>
                    <p class="experience">{!! nl2br($submission->experience)!!}</p>
                <div class="submission-controls">
                    <form action="{{route('submission.accept',["submission"=>$submission->id])}}"method="post">
                        @csrf
                        @method('POST')
                        <input type="submit" value="Accepter">
                    </form>
                    <form action="{{route('submission.reject',["submission"=>$submission->id])}}"method="post">
                        @csrf
                        @method('POST')
                        <input type="submit" value="Rejeter">
                    </form>
                </div>
            </div>
</x-app-layout>