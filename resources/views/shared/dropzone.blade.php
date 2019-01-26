<h6 class="text-center">Photos</h6>
<div id="file" class="dropzone"></div>

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var files = @json($event->photos()->where(
                'user_id', Auth::user()->id
            )->select(['filename as name', 'event_id as size'])->get());
            var dropzone = new Dropzone('#file', {
                addRemoveLinks: true,
                url: "{{ route('uploads.store', ['event' => $event]) }}",
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
                },
                removedfile: function (file) {
                    axios.delete("{{ route('uploads.delete', ['filename' => '']) }}", { params: { filename: file.name }});
                    file.previewElement.remove();
                }
            });
            $.each(files, function (key, value) {
                var mockFile = { name: value.name, size: value.size };
                dropzone.options.addedfile.call(dropzone, mockFile);
                dropzone.options.thumbnail.call(dropzone, mockFile, "{{asset('storage/photos')}}/" + mockFile.name);
            })
        });
    </script>
@endsection
