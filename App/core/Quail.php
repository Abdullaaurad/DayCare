<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enhanced Quill.js Editor</title>
    
    <!-- Load Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Open+Sans:wght@400;700&family=Lato:wght@400;700&family=Montserrat:wght@400;700&family=Playfair+Display:wght@400;700&family=Source+Code+Pro&display=swap" rel="stylesheet">
    
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <style>
        #editor {
            height: 400px;
            border: 1px solid #ccc;
        }
        
        .ql-toolbar {
            background: #f5f5f5;
        }
        
        .ql-container {
            height: 350px;
        }

        .ql-undo::before {
            font-family: "Font Awesome 5 Free";
            content: "\f0e2";
            font-weight: 900;
        }

        .ql-redo::before {
            font-family: "Font Awesome 5 Free";
            content: "\f01e";
            font-weight: 900;
        }

        .ql-clear::before {
            font-family: "Font Awesome 5 Free";
            content: "\f12d"; /* Trash icon */
            font-weight: 900;
        }

        /* Custom Font Styles */
        .ql-snow .ql-picker.ql-font .ql-picker-label[data-value="arial"]::before,
        .ql-snow .ql-picker.ql-font .ql-picker-item[data-value="arial"]::before {
            content: 'Arial';
            font-family: 'Arial', sans-serif;
        }

        .ql-snow .ql-picker.ql-font .ql-picker-label[data-value="roboto"]::before,
        .ql-snow .ql-picker.ql-font .ql-picker-item[data-value="roboto"]::before {
            content: 'Roboto';
            font-family: 'Roboto', sans-serif;
        }

        .ql-snow .ql-picker.ql-font .ql-picker-label[data-value="open-sans"]::before,
        .ql-snow .ql-picker.ql-font .ql-picker-item[data-value="open-sans"]::before {
            content: 'Open Sans';
            font-family: 'Open Sans', sans-serif;
        }

        .ql-snow .ql-picker.ql-font .ql-picker-label[data-value="lato"]::before,
        .ql-snow .ql-picker.ql-font .ql-picker-item[data-value="lato"]::before {
            content: 'Lato';
            font-family: 'Lato', sans-serif;
        }

        .ql-snow .ql-picker.ql-font .ql-picker-label[data-value="montserrat"]::before,
        .ql-snow .ql-picker.ql-font .ql-picker-item[data-value="montserrat"]::before {
            content: 'Montserrat';
            font-family: 'Montserrat', sans-serif;
        }

        .ql-snow .ql-picker.ql-font .ql-picker-label[data-value="playfair"]::before,
        .ql-snow .ql-picker.ql-font .ql-picker-item[data-value="playfair"]::before {
            content: 'Playfair';
            font-family: 'Playfair Display', serif;
        }

        .ql-snow .ql-picker.ql-font .ql-picker-label[data-value="source-code"]::before,
        .ql-snow .ql-picker.ql-font .ql-picker-item[data-value="source-code"]::before {
            content: 'Source Code';
            font-family: 'Source Code Pro', monospace;
        }

        /* Font classes for the editor content */
        .ql-font-arial {
            font-family: 'Arial', sans-serif;
        }
        .ql-font-roboto {
            font-family: 'Roboto', sans-serif;
        }
        .ql-font-open-sans {
            font-family: 'Open Sans', sans-serif;
        }
        .ql-font-lato {
            font-family: 'Lato', sans-serif;
        }
        .ql-font-montserrat {
            font-family: 'Montserrat', sans-serif;
        }
        .ql-font-playfair {
            font-family: 'Playfair Display', serif;
        }
        .ql-font-source-code {
            font-family: 'Source Code Pro', monospace;
        }
    </style>
</head>
<body>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add custom fonts
            const Font = Quill.import('formats/font');
            Font.whitelist = [
                'arial',
                'roboto',
                'open-sans',
                'lato',
                'montserrat',
                'playfair',
                'source-code'
            ];
            Quill.register(Font, true);

            // Add undo and redo buttons to toolbar
            const editor = new Quill('#editor', {
                theme: 'snow',
                modules: {
                    toolbar: {
                        container: [
                            [{ 
                                'font': [
                                    'arial',
                                    'roboto',
                                    'open-sans',
                                    'lato',
                                    'montserrat',
                                    'playfair',
                                    'source-code'
                                ]
                            }],
                            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                            ['bold', 'italic', 'underline', 'strike'],
                            [{ 'align': [] }],
                            [{ 'color': [] }, { 'background': [] }],
                            [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                            ['blockquote', 'code-block'],
                            ['link', 'image', 'video'],
                            ['undo', 'redo', 'clear'], // Add the clear button
                            ['clean']
                        ],
                        handlers: {
                            undo: function() {
                                editor.history.undo();
                            },
                            redo: function() {
                                editor.history.redo();
                            },
                            clear: function() {
                                editor.setText(''); // Clear all content
                            }
                        }
                    },
                    history: {
                        delay: 1000,
                        maxStack: 500,
                        userOnly: true
                    }
                }
            });

            // Enable keyboard shortcuts
            editor.keyboard.addBinding({ key: 'Z', shortKey: true }, () => {
                editor.history.undo();
            });
            editor.keyboard.addBinding({ key: 'Z', shortKey: true, shiftKey: true }, () => {
                editor.history.redo();
            });
        });
    </script>
</body>
</html>
