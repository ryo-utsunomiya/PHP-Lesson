<?php
$a = 0;
$b = 0;
$c = 0;
$d = 0;
$total = 0;

for ( $j = 1 ; $j <= 20 ; $j++ ) {

if (isset($_GET["$j"]) && $j == 1 || isset($_GET["$j"]) && $j == 6 || isset($_GET["$j"]) && $j == 10 || isset($_GET["$j"]) && $j == 13 || isset($_GET["$j"]) && $j == 19) $a++;
elseif (isset($_GET["$j"]) && $j == 2 || isset($_GET["$j"]) && $j == 4 || isset($_GET["$j"]) && $j == 9 || isset($_GET["$j"]) && $j == 15 || isset($_GET["$j"]) && $j == 17) $b++;
elseif (isset($_GET["$j"]) && $j == 3 || isset($_GET["$j"]) && $j == 8 || isset($_GET["$j"]) && $j == 11 || isset($_GET["$j"]) && $j == 16 || isset($_GET["$j"]) && $j == 20) $c++;
elseif (isset($_GET["$j"]) && $j == 5 || isset($_GET["$j"]) && $j == 7 || isset($_GET["$j"]) && $j == 12 || isset($_GET["$j"]) && $j == 14 || isset($_GET["$j"]) && $j == 18) $d++;
}

$total = $a + $b + $c + $d;

$yA = 137 - $a * 24;
$yB = 137 - $b * 24;
$yC = 137 - $c * 24;
$yD = 137 - $d * 24;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>「メンタル筋力度」自己診断シート</title>
	<style type="text/css">
	table{ border-collapse: collapse;}
	th, td{ text-align:center; border:solid 1px #000000; padding:5px;}
	a{ color: #000000; text-decoration: none;}
	a#reset{ display: block; margin: 10px; cursor: none;}
	</style>
<script type="text/javascript">
window.onload = function() {
	  var canvas = document.getElementById('graph');
	  if (canvas.getContext) {
	    var ctx = canvas.getContext('2d');
	    var points = [ { x : 10, y : <?php echo $yA;?> },
	                   { x : 50, y : <?php echo $yB;?> },
	                   { x : 90, y : <?php echo $yC;?> },
	                   { x : 130, y : <?php echo $yD;?> }];
	    ctx.strokeStyle = "#000000";
	    ctx.beginPath();
	    ctx.moveTo(10, 10);
	    ctx.lineTo(10, 140);
	    ctx.lineTo(140, 140);
	    ctx.stroke();
	    ctx.strokeStyle = "#CC0000";
	    ctx.beginPath();
	    for (i = 0, j = points.length; i < j; i++) {
	      if (i == 0) {
	        ctx.moveTo(points[i].x, points[i].y);
	      }
	      else {
	        ctx.lineTo(points[i].x, points[i].y);
	      }
	    }
	    ctx.stroke();
	  }
	};
</script>
</head>
<body>
<div>
<h1><a href="<?php echo $_SERVER['PHP_SELF'];?>">「メンタル筋力度」自己診断シート</a></h1>
<?php
if (!empty($_GET['sent'])) {
?>
<table>
	<tbody>
		<tr><th>A</th><th>B</th><th>C</th><th>D</th><th>A〜D合計</th></tr>
		<tr><td><?php echo $a;?></td><td><?php echo $b;?></td>	<td><?php echo $c;?></td><td><?php echo $d;?></td>	<td><?php echo $total;?></td></tr>
	</tbody>
</table>
<?php
    $type = '';
    if ($a <= $b+1 && $a >= $b-1 && $b <= $c+1 && $b >= $c-1 && $c <= $d+1 && $c >= $d-1 && $d <= $a+1 && $d >= $a-1) $type = 'バランス';
    elseif (($a == 0 || $b == 0 || $c == 0 || $d == 0)&&($a == 5 || $b == 5 || $c == 5 || $d == 5)) $type = '乱高下';
    elseif ($a>=3 && $b<3 && $c<3 && $d>=3) $type = '両サイド突出';
    elseif ($a<3 && $b>=3 && $c>=3 && $d<3) $type = '富士山';
    elseif ($a>$b && $b>=$c && $c>=$d) $type = '頭でっかち';
    elseif ($a<=$b && $b<=$c && $c<$d) $type = '人間関係先行';

    if (!empty($type)) echo "<p>あなたは<span style='font-weight: bold; color: #CC0000;'>".$type."</span>型です。</p>";
    else echo "<p>あなたに当てはまる型はありません</p>";

    echo "<div style='position: absolute; top: 70px; left: 350px;'><canvas id='graph' width='150' height='150'>Your browser does not support the HTML 5 Canvas.</canvas></div>";
}
?>
<p style="clear:both;">当てはまる項目にチェックを入れてください。</p>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
<?php
$text = array(1=>
		'オーディオブックで耳勉強',
		'メールの返信はとにかく速い',
		'すでに結婚している、または子どもがいる',
		'人から薦められた本はすぐに買って読む',
		'相手のひどい言動に対しても、怒らずクールに対応している',

		'睡眠は毎日６時間以上取る',
		'妬まない・怒らない・愚痴らない',
		'週２回以上体を動かしている',
		'ノートPCをいつでもどこでも持ち歩いている',
		'１日１回、今日の予定を頭の中でイメージする',

		'ブログを毎日書いている',
		'応援してくれる人が多い',
		'加速学習（マインドマップ・フォトリーディング）',
		'お礼状は欠かさない',
		'質問に即答できる',

		'時間の使い方はケチ',
		'仕事に何から手をつければいいか、すぐ決めることができる',
		'酒の席で愚痴る人とは付き合いたくない',
		'１ヶ月に５冊以上本を読んでいる',
		'１ヶ月に３人は新しい知り合いが増える'
);

 for ($i = 1;$i <= 20;$i++) {

    echo "<input type='checkbox' id='".$i."' name='".$i."'value='1'";
    if(isset($_GET["{$i}"])) echo " checked ";
    echo "><label for='".$i."'>" . $text["$i"] ."</label><br />\n";
}
?>
<input type="hidden" name="sent" value="sent" />
<input type="submit" value="結果を見る" style="padding:10px; margin: 10px;" />
</form>

<a id="reset" href="<?php echo $_SERVER['PHP_SELF']?>"><button>リセット</button></a>
</div>
</body>
</html>