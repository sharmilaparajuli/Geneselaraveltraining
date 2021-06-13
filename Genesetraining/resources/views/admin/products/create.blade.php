<x-admin.layout>
    <div class="az-content az-content-dashboard">
        <div class="container">
            <div class="az-content-body">
                <!-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif -->
                <h2>Create product</h2>
                <form action="/admin/products/store" method="post" enctype="multipart/form-data">
                    @csrf
                    product Name:<input type="text" name="product_name" value="{{ old('product_name') }}" id="" class="form-control">
                    @error('product_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <br><br>
                   
                    product Description:<textarea type="text" name="product_desc"
                         class="form-control" id="" cols="30" rows="10">{{ old('product_desc') }}
                        </textarea> 
                        @error('product_desc')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <br><br>
                        <br><br>
                    price:<input type="text" name="price" class="form-control" value="{{ old('price') }}"id="">
                    @error('product_desc')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <br><br>
                    categories:<select name="category_id" class="form-control" id="">
                        <option value="0">Select a categories</option>
                        @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <br><br>
                <input type="file" name="image" id=""><br><br>
                    <button type="submit" class="form-control">Submit</button>
                </form>
            </div>
        </div>
    </div>
</x-admin.layout>