<footer>
    @auth
        <form action="{{ route('flats.comments.store', ['flat' => $flat->id]) }}" method="POST" class="bg-white border border-gray-200 p-4 rounded-xl m-4">
            @csrf
            <header class="flex flex-col items-center gap-4 p-4 bg-gray-100 rounded-xl shadow-md transition duration-300 hover:shadow-lg">
                <div class="flex items-center gap-2">
                    <img src="https://i.pravatar.cc/100?img={{ auth()->id() }}" alt="avatar" class="rounded-full">
                    <h3 class="text-xl font-bold">Wants to let a Review?</h3>
                </div>

                <div class="flex flex-col items-center mt-4 w-full">
                    <textarea class="w-full p-3 border rounded-md focus:outline-none focus:border-blue-500 resize-none" name="body" id="body" rows="3" placeholder="Share your thoughts..."></textarea>

                    <button class="mt-4 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md transition duration-300 focus:outline-none focus:shadow-outline-blue" type="submit">Post</button>
                </div>
            </header>
        </form>
    @endauth

    @foreach ($comments->reverse() as $comment)
        <div class="m-4 border bg-blue-200 rounded-md relative">
            <article class="flex items-center p-2">
                <div class="flex flex-col items-center mr-4">
                    <img src="https://i.pravatar.cc/100?img={{ $comment->user->id }}" alt="avatar" class="rounded-full w-10 h-10">
                    <header class="flex flex-col items-center text-xs">
                        <h3 class="font-bold">{{ $comment->user->name }}</h3>
                        <p><time>{{ $comment->created_at->diffForHumans() }}</time></p>
                    </header>
                </div>

                <div class="flex-grow">
                    <div class="chat chat-start">
                        <div class="chat-bubble">{{ $comment->body }}</div>
                    </div>
                </div>

                @if (auth()->check() && auth()->id() === $comment->user->id)
                <div class="absolute top-0 right-0 delete-button">
                    <form action="{{ route('flats.comments.delete', ['flat' => $flat->id, 'comment' => $comment->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="text-black m-4 p-2 transition duration-300 hover:bg-red-700">
                            <i class="fas fa-times"></i>
                        </button>
                    </form>
                </div>

                @endif

                @if(session('success'))
                    <div id="success-message" class="fixed bottom-0 right-0 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 z-50">
                        <p>{{ session('success') }}</p>
                    </div>
                    <script>
                        setTimeout(function() {
                            document.getElementById('success-message').style.display = 'none';
                        }, 2000);
                    </script>
                @endif
            </article>
        </div>
    @endforeach
</footer>
