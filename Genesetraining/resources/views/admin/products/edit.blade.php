<x-admin.layout>
    <div class="az-content az-content-dashboard">
        <div class="container">
            <div class="az-content-body">
            <h2>Edit product</h2>
                <form action="/admin/products/update/{{$product->id}}" method="get">
                    @csrf
                    product Name:<input type="text" name="product_name" class = "form-control"value="{{$product->product_name}}" id=""><br><br>
                    product Description:<textarea type="text" name="product_desc"class = "form-control" value="{{$product->product_desc}}" id="" cols="30" rows="10">{{$product->product_desc}}</textarea><br><br>
                    price:<input type="text" name="price" value="{{$product->price}}"class = "form-control" id=""><br><br>
                    categories:<select name="category_id"class = "form-control" id="">
                        <option value="0">Select a categories</option>
                        @foreach($categories as $category)
                        <option value="{{$category->id}}" @if($category->id == $product->category_id) selected @endif>{{$category->category_name}}</option>
                        @endforeach
                    </select><br><br>

                    <button type="submit"class = "form-control">Update</button>
                </form>
            </div>
        </div>
    </div>
</x-admin.layout>