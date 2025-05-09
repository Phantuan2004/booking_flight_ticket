@if (session('flash_message'))
    <div class="alert alert-{{ session('flash_message.type') }}"
        style="margin-bottom: 20px; padding: 15px; border-radius: 4px; background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb;">
        {{ session('flash_message.message') }}
    </div>
@endif
