@extends('layouts.app')

@section('content')
<div class="container">
    <table class="table table-striped table-hover mt-4">
        <tr>
            <td>Name</td>
            <td>Email</td>
            <td>Campus</td>
            <td>Role</td>
        </tr>

        @foreach ($users as $user)
            <tr>
                <td>{{ $user->fname }} {{ $user->lname }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->campus }}</td>
                <td>
                    <form method="POST" action="{{ route('users.update', compact('user')) }}">
                        @csrf
                        @method('PUT')
                        <select name="role" id="role" class="form-control">
                            @foreach ($roles as $role)
                                <option value="{{ $role }}" {{ ($user->role === $role) ? 'selected' : '' }}>{{ ucfirst($role) }}</option>
                            @endforeach
                        </select>
                        <input type="submit" value="update!" class="btn btn-link">
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</div>
@endsection
