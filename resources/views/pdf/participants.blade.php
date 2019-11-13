<style>
.table {
  width: 100%;
  max-width: 100%;
  margin-bottom: 1rem;
}

.table th,
.table td {
  padding: 0.25rem;
  vertical-align: top;
}

.table .table {
  background-color: #fff;
}
</style>
<h1>{{ $event->name }}</h1>
<h2>{{ $event->planned_on->format('d M Y') }}</h2>
<hr>
<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col" style="width: 25%">Name</th>
            <th scope="col" style="width: 50%">Email</th>
            <th scope="col" style="width: 25%">Campus</th>
        </tr>
    </thead>

    @foreach ($participants as $participant)
        <tr>
            <td>{{ $participant->fname }} {{ $participant->lname }}</td>
            <td>{{ $participant->email }}</td>
            <td>{{ $participant->campus }}</td>
        </tr>
    @endforeach
</table>
