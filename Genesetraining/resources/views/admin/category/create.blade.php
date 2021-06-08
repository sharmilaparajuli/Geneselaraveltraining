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
                <h2>Create categories</h2>
                <form action="/admin/category/store" method="post">
                    @csrf
                    Category Name:<input type="text" name="category_name" value="{{ old('category_name') }}" id="" class="form-control">
                    @error('category_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <br><br>
                   
                    Category Description:<textarea type="text" name="category_desc"
                         class="form-control" id="" cols="30" rows="10">{{ old('category_desc') }}
                        </textarea> 
                        @error('category_desc')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <br><br>
                        <br><br>
                    Parent categories:<select name="parent_id" class="form-control" id="">
                        <option value="0">Select a categories</option>
                        @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <br><br>

                    <button type="submit" class="form-control">Submit</button>
                </form>
            </div>
        </div>
    </div>
</x-admin.layout>