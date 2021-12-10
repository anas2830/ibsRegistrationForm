@foreach ($usersData as $key => $user )
    <tr>
        <td>{{$key+1}}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->division_name }}</td>
        <td>{{ $user->district_name }}</td>
        <td>{{ $user->upazila_name }}</td>
        <td>{{ $user->created_at->toDateString() }}</td>
        <td>Edit</td>
    </tr>
@endforeach

<tr class="exam_pagin_link">
    <td colspan="6">{{ $usersData->links() }}</td>
</tr>