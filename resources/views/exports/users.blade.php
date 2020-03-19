<table>
    <thead>
    <tr>
        <th> N° </th>
        <th>Área</th>
        <th>Name</th>
        <th>Cargo</th>
        <th>Código</th>
        <th>Firma</th>

    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->place->title }}</td>
            <td>{{ $user->firstname }}</td>
            <td>{{ $user->charge->title }}</td>
            <td>{{ $user->email }}</td>
            
        </tr>
    @endforeach
    </tbody>
</table>