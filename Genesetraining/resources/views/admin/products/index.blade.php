<x-admin.layout>
    <div class="az-content az-content-dashboard">
        <div class="container">
            <div class="az-content-body">
                <table align="center"class="table table-striped">
                    <a href="/admin/products/create">Create product</a>
                    <tr>
                        <th>SN</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                    @foreach($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->product_name}}</td>
                        <td>{{$product->product_desc}}</td>
                        <td>{{$product->price}}</td>
                        <td>
                            <a href="/admin/products/edit/{{$product->id}}">Edit</a>
                            <a href="/admin/products/destroy/{{$product->id}}">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</x-admin.layout>