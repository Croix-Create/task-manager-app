@extends('components.layout')

@section('content')
    <div class="container mx-auto mt-6">
        <h2 class="text-2xl font-bold mb-4">Edit Task</h2>

        <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            @method('PUT')

            <!-- Title Input -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="title">Title</label>
                <input type="text" name="title" id="title" 
                       value="{{ old('title', $task->title) }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <!-- Description Input -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">Description</label>
                <textarea name="description" id="description" rows="3"
                          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('description', $task->description) }}</textarea>
            </div>

            <!-- Due Date Input -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="due_date">Due Date</label>
                <input type="date" name="due_date" id="due_date" 
                       value="{{ old('due_date', $task->due_date) }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <!-- Status Select -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="status">Status</label>
                <select name="status" id="status"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="pending" {{ old('status', $task->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in progress" {{ old('status', $task->status) == 'in progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="completed" {{ old('status', $task->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-between">
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Update Task
                </button>
            </div>
        </form>
    </div>
@endsection
