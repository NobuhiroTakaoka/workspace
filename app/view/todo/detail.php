<?php
require_once('./../../controller/TodoController.php');

$controller = new TodoController;
$todo = $controller->detail();
?>

<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>詳細画面</h1>
    <div>
        <div>タイトル</div>
        <div><?php echo $todo['title'];?></div>
    </div>
    <div>
        <div>詳細</div>
        <div><?php echo $todo['detail'];?></div>
    </div>
    <div>
        <div>ステータス</div>
        <div><?php echo $todo['display_status'];?></div>
    </div>
    <div>
        <button>
            <a href="./edit.php?todo_id=<?php echo $todo['id']; ?>">編集</a>
        </button>
    </div>

</body>
</html>