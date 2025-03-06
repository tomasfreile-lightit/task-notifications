<x-mail::message>
<div class="container">
<div class="header">
<h1>{{ $header }}</h1>
</div>
<div class="content">
<div class="task-title">{{ $title }}</div>
<div class="task-description">{{ $description }}</div>
<a href="{{ $taskUrl }}" class="btn">View Task</a>
</div>
</div>
</x-mail::message>
