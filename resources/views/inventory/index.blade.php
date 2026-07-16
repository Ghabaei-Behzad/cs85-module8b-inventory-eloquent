


<h1>Inventory Items</h1>
<ul>
@foreach($items as $item)
    <li>{{ $item->item_name }} ({{ $item->quantity }}) - {{ $item->category }}</li>
@endforeach
</ul>

{{--
Behzad Ghabaei
CS 85 php - Module 8 Assign. 8B
Instructor Seno - 7/16/2026

Reflection:
Eloquent simplified how I interacted with the database.
It helped me write less code and think in objects instead of queries.
It’s a more modern, scalable way to work with data.
--}}
