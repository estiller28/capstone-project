<table class="table table-striped display nowrap" style="width:100%">
    <thead>
    <tr>
        <th class="" scope="col">ID
        <th class="" scope="col">First Name</th>
        <th class="" scope="col">Middle Name</th>
        <th class="" scope="col">Last Name</th>
        <th class="" scope="col">Date Created</th>
    </tr>
    </thead>
    <tbody>
        @foreach($citizens as $citizen)
            <tr>
                <td>{{$citizen->id}}</td>
                <td>{{$citizen->first_name}}</td>
                <td>{{$citizen->middle_name}}</td>
                <td>{{$citizen->last_name}}</td>
                <td>{{$citizen->created_at}}</td>
            </tr>
        @endforeach
    </tbody>
</table>



<style>
   *{
       color: red;
   }
</style>
