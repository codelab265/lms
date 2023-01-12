@forelse ($books as $book)
    <div class="list-group">
        <a href="#" class="list-group-item list-group-item-action search_result" id="{{ $book->id }}"
            data-title="{{ $book->title }}" data-category="{{ $book->category->name }}"
            data-categoryid="{{ $book->category_id }}" data-author="{{ $book->author }}"
            data-access="{{ $book->accessNumber }}">
            {{ $book->title }} by <span class="text-primary">{{ $book->author }}</span>
        </a>
    </div>
@empty
    <div class="alert alert-danger">
        No search results!!
    </div>
@endforelse
