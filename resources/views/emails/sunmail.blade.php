<body>

   {{ print($message)  }}

   <h3>Sunlight send propose to "{{ ' ' . $subject }}"</h3>
   <div>{{ ' ' . $message }}</div>
{{--
    @if ($data['file'])
        <div>
            <h3>Attached file</h3>
        </div>
    @endif--}}

</body>
