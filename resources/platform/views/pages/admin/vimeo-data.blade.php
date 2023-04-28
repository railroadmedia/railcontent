<!DOCTYPE html>
<html>
<head>
    <title>Vimeo Data</title>
</head>
<body>
<table>
    <tr>
        <th>id</th>
        <th>name <br/></th>
        <th>size <br/>
        </th>
    </tr>
    @foreach($data as $row)
        <tr>
            <td>
                {{$row['id']}}
            </td>
            <td>
                <a id="download-link-{{$row['id']}}" href="{{$row['source_download']['link']}}" download>
                    {{$row['name']}}
                </a>
            </td>
            <td>
                {{$row['source_download']['size']}}
            </td>
        </tr>
    @endforeach
</table>
</body>
</html>
