<div style="max-width: 600px; text-align: center; margin: 50px auto;">
    <h1>Wickk Studio</h1>
    <h2>Hello, you order:</h2>
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="text-align: center; font-size: 16px; text-transform: uppercase;">
                <th style="padding: 5px; border-bottom: 1px solid black;">Name</th>
                <th style="padding: 5px; border-bottom: 1px solid black;">Quality</th>
                <th style="padding: 5px; border-bottom: 1px solid black;">Price</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($session['cart'] as $item): ?>
            <tr style="text-align: center; font-size: 14px; text-transform: uppercase;">
                <td><?= $item['name'] ?></td>
                <td><?= $item['quality'] ?></td>
                <td><?= $item['price'] * $item['quality'] ?></td>
            </tr>
        <?php endforeach; ?>
        <tr style="text-align: center; font-size: 16px; text-transform: uppercase; border-top: 2px solid black;">
            <td colspan="1">TOTAL:</td>
            <td><?= $session['cart.quality'] ?></td>
            <td><?= $session['cart.sum'] ?></td>
        </tr>
        </tbody>
    </table>
</div>