<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AI Review Test Page</title>
</head>
<body>
    <div style="color: red; font-size: 20px; background-color: #f0f0f0; padding: 15px; margin-bottom: 20px;">
        <h1 style="font-weight: bold; text-decoration: underline;">Test AI Reviewer Project View</h1>
        <p style="color: blue; font-family: 'Courier New', Courier, monospace;">This view is full of intentional rule violations.</p>
    </div>

    <div>
        <ul>
            @foreach($postsWithComments as $item)
                <li>Project: {{ $item['project']->title }}</li>
            @endforeach
        </ul>
    </div>

    <button onclick="alert('Warning: Inline event listener used!')" style="padding: 10px; background: red; color: white;">
        Click Me (Inline JS Test)
    </button>

    <script>
        // Bad Practice: Direct script inside blade and raw DOM query
        var pageTitle = document.getElementsByTagName('title')[0].innerHTML;
        console.log("Current page title is: " + pageTitle);

        document.write("<p style='color: green;'>Injected text via document.write (Violation)</p>");
    </script>
</body>
</html>
