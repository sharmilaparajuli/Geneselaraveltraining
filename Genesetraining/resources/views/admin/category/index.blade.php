<x-admin.layout>
    <div class="az-content az-content-dashboard">
        <div class="container">
            <div class="az-content-body">
                <table align="center"class="table table-striped">
                    <a href="/admin/category/create">Create Categories</a>
                    <tr>
                        <th>SN</th>
                        <th> Category Name</th>
                        <th> Category Description</th>
                        <th>Slug</th>
                        <th>Action</th>
                    </tr>
                    @foreach($categories as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->category_name}}</td>
                        <td>{{$category->category_desc}}</td>
                        <td>{{$category->slug}}</td>
                        <td>
                            <a href="/admin/category/edit/{{$category->id}}">Edit</a>
                            <a href="/admin/category/destroy/{{$category->id}}">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</x-admin.layout>