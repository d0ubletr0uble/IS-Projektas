@extends('layouts.app')

@section('content')
    @if (\Session::has('status'))
        <div class="alert alert-warning">
            <p>{!! \Session::get('status') !!}</p>
        </div>
        @elseif(\Session::has('good'))
        <div class="alert alert-success">
            <p>{!! \Session::get('good') !!}</p>
        </div>
    @endif

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <table class="table table-striped">
                    <thead>
                    <th>Slapyvardis</th>
                    <th>Veiksmas</th>
                    <th></th>
                    <th></th>
                    </thead>
                    <tbody>
                    @foreach($futurememb as $futurememb)
                        <tr>
                        <td>{{$futurememb->username}}</td>
                        <td>
                            <form action = "{{route('member.add',$id->id)}}" method="post" onsubmit= 'return ConfirmDelete()'>
                                {{csrf_field() }}
                                <input type="hidden" name="futumemb_id" value={{$futurememb->id}} />
                                <input type="hidden" name="futumemb_name" value={{$futurememb->username}} />
                                <button type="submit" class="btn btn-primary">Pridėti</button>
                            </form>
                        </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <td>
                    <a href="/messages/groups/{{$id->id}}/edit" class="btn btn-info">Grįžti</a>
                </td>
                </div>
            </div>
        </div>
    <script>

        function ConfirmDelete()
        {
            var x = confirm("Ar tikrai norite pridėti narį?");
            if (x)
                return true;
            else
                return false;
        }

    </script>
@endsection
