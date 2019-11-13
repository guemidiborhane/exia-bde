<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col" style="width: 15%">Title</th>
            <th scope="col" style="width: 60%">Description</th>
            <th scope="col" style="width: 15%">Date</th>
            <th scope="col" class="text-center">Participants</th>
        </tr>
    </thead>

    @foreach ($participants as $participant)
        <tr>
            <td>{{ $participant->fname }}</td>
            <td>{{ $participant->lname }}</td>
            <td>{{ $participant->campus }}</td>
            <td>{{ $participant->email }}</td>
        </tr>
    @endforeach
</table>
