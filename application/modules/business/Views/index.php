<style>
    .hero-unit h1{
        font-size: 35px;
    }
    p{
        text-align: justify;
        font-size:14px;
    }
    .star-rating{
        width: 190px !important;
        height: 38px !important;
    }
    .span4{
        box-shadow: 1px 1px 13px 2px #F7F7F7;
        border-radius: 7px;
        padding: 6px 10px;
    }
    .span4:hover{
        box-shadow: 1px 1px 13px 2px #EFEFEF;
        background: #F7F7F7;
    }
    </style>
    <link rel="stylesheet" href="<?= base_url('theme/css/rating.css')?>">

    <div class="row">
    <?php foreach($business as $key => $item):?>
        
        <div class="span4">
        
            <div class="text-default">
                <a href="<?= base_url('/business/details/'.$item->id)?>">
                <h1><?= $item->company_name?></h1>
                </a>
                <p align="j"><?= substr($item->description, 0, 70)?></p>

                <span class="star-rating">
                <?php for($i=1;$i<=5;$i++):?>
                  <input type="radio" disabled="disabled" name="rating_<?= $key?>" value="<?= $i;?>" id="<?= $item->id?>" <?= ($item->rating == $i) ? 'checked' : ''?> ><i></i>
                <?php endfor;?>
                </span>
            </div>
        </div>
    <?php endforeach;?>
    </div>

