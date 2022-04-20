<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="shortcut icon" href="<?= base_url('public/img/logo/premice.png') ?>" type="image/x-icon">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>
    </head>
    <body>
        <div class="container" id="imprim">
            <div class="card">
                <div class="card-body">
                    <div id="invoice"> 
                        <div class="invoice overflow-auto">
                            <div style="min-width: 600px">
                                <header>
                                    <div>
                                        <img src="<?= base_url('public/img/logo/premice.png') ?>" alt="Premice Logo" class="brand-image img-circle elevation-3" style="text-align: center;" width="100" height="100">
                                    </div>
                                </header>
                                <main>
                                    <div class="col invoice-to">
                                        <div class="text-gray-light">Facture de Mr / Mme:</div>
                                        <h2 class="to"> <?= $clients["nom_cli"] ?></h2>
                                        <div class="address">Adresse: <?= $clients["adresse"] ?>,<?= $clients["pays"] ?></div>
                                        <div class="email">E-mail: <a href="<?= $clients["email_cli"] ?>"><?= $clients["email_cli"] ?></a></div>
                                        <div class="address">Tel: <?= $clients["phone_cli"] ?></div>    
                                    </div>
                                    <div class="col invoice-details">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Libelle</th>
                                                    <th>Description</th>
                                                    <th>QT</th>
                                                    <th>Prix</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $somtva = 0;
                                                $somme = 0;
                                                foreach($articles as $key=>$value): ?>
                                                <tr>
                                                    <td><?= $value["nom_pro"] ?></td>
                                                    <td><?= $value["description"]  ?></td>
                                                    <td class="qty"><?=$value["quantite"]?></td>
                                                    <td class="unit"><?=$value["prix_u"]?> F</td>
                                                    <td class="total"><?=($value["prix_u"]*$value["quantite"])?> Fcfa</td>
                                                </tr>
                                                <?php 
                                                $somme = $somme + ($value["prix_u"]*$value["quantite"]);

                                                $somtva = $value["prix_u"] + ($value["prix_u"]*$value['tva']/100)*$value['quantite'] ; 

                                                $somTtc = ($somtva) + $somme;
                                                ?>
                                                <?php endforeach?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="">
                                        <p>
                                            Prix Total: <strong class="thanks totaux"><?= $somme; ?> Fcfa</strong>
                                        </p>
                                    </div>
                                    <div class="">
                                        <p>
                                            Prix TTC: &nbsp&nbsp<strong class="thanks ttc"><?= $somTtc; ?> Fcfa</strong>
                                        </p>
                                    </div>
                                    <img src="<?= base_url('public/img/logo/signature.jpg') ?>" alt="Premice Logo" class="brand-image img-circle elevation-3" style="text-align: center;" width="50" height="50"><br>
                                    <strong>Premice Computer</strong> 

                                    <div class="text-end">
                                        <button type="button" class="btn btn-dark" onclick="window.print()"><i class="fa fa-print"></i> imprime</button>
                                    </div>
                                </main>
                                <footer>
                                    Les produits livrés ne peuvent être remboursés qu'en cas de panne avant la fin de la garantie.
                                </footer>
                            </div>
                            <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<script type="text/javascript">
  function imprimer(imprime) {
   var printContents = document.getElementById("imprime").innerHTML;    
   var originalContents = document.body.innerHTML;      
   document.body.innerHTML = printContents;     
   window.print();
   document.body.innerHTML = originalContents;
  }
</script>

<style>
    body {
        margin-top: 20px;
        background-color: #f7f7ff;
    }

    #invoice {
        padding: 0px;
    }

    .invoice {
        position: relative;
        background-color: #FFF;
        min-height: 680px;
        padding: 15px
    }

    .invoice header {
        padding: 10px 0;
        margin-bottom: 20px;
        border-bottom: 1px solid #0d6efd
    }

    .invoice .company-details {
        text-align: right
    }

    .invoice .company-details .name {
        margin-top: 0;
        margin-bottom: 0
    }

    .invoice .contacts {
        margin-bottom: 20px
    }

    .invoice .invoice-to {
        text-align: left
    }

    .invoice .invoice-to .to {
        margin-top: 0;
        margin-bottom: 0
    }

    .invoice .invoice-details {
        text-align: right
    }

    .invoice .invoice-details .invoice-id {
        margin-top: 0;
        color: #ffff00
    }

    .invoice main {
        padding-bottom: 50px
    }

    .invoice main .thanks {
        margin-top: -100px;
        font-size: 2em;
        margin-bottom: 50px
    }

    .invoice main .notices {
        padding-left: 6px;
        border-left: 6px solid #0d6efd;
        background: #e7f2ff;
        padding: 10px;
    }

    .invoice main .notices .notice {
        font-size: 1.2em
    }

    .invoice table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 20px
    }

    .invoice table td,
    .invoice table th {
        padding: 15px;
        background: #eee;
        border-bottom: 1px solid #fff
    }

    .invoice table th {
        white-space: nowrap;
        font-weight: 400;
        font-size: 16px
    }

    .invoice table td h3 {
        margin: 0;
        font-weight: 400;
        color: #0d6efd;
        font-size: 1.2em
    }

    .invoice table .qty,
    .invoice table .total,
    .invoice table .unit {
        text-align: right;
        font-size: 1.2em
    }

    .invoice table .no {
        color: #fff;
        font-size: 1.6em;
        background: #0d6efd
    }

    .invoice table .unit {
        background: #ddd
    }

    .invoice table .total, .totaux {
        background: #0d6efd;  
    } 
     .ttc {
        background: #ffff00;  
    } 

    .invoice table tbody tr:last-child td {
        border: none
    }

    .invoice table tfoot td {
        background: 0 0;
        border-bottom: none;
        white-space: nowrap;
        text-align: right;
        padding: 10px 20px;
        font-size: 1.2em;
        border-top: 1px solid #aaa
    }

    .invoice table tfoot tr:first-child td {
        border-top: none
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0px solid rgba(0, 0, 0, 0);
        border-radius: .25rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
    }

    .invoice table tfoot tr:last-child td {
        color: #0d6efd;
        font-size: 1.4em;
        border-top: 1px solid #0d6efd
    }

    .invoice table tfoot tr td:first-child {
        border: none
    }

    .invoice footer {
        width: 100%;
        text-align: center;
        color: #777;
        border-top: 1px solid #aaa;
        padding: 8px 0
    }

    @media print {
        .invoice {
            font-size: 11px !important;
            overflow: hidden !important
        }

        .invoice footer {
            position: absolute;
            bottom: 10px;
            page-break-after: always
        }

        .invoice>div:last-child {
            page-break-before: always
        }
    }

    .invoice main .notices {
        padding-left: 6px;
        border-left: 6px solid #0d6efd;
        background: #e7f2ff;
        padding: 10px;
    }
</style>