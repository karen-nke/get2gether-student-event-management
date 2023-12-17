<div class ="section-container">
        <p class ="section-title">Registered Event</p>

            <div class="event-container">

            <?php
                if (!empty($registeredEvents)) {
                    foreach ($registeredEvents as $event) {
            ?>

            <a href="event_single.php?id=<?= $event['id']; ?>">
                            <div class="event-card">
                                <img src="<?= $event['event_image_path']; ?>" alt="Event Image">
                                <h2 class="title"><?= $event['event_title']; ?></h2>
                                <p class="date">Date & Time: <?= $event['start_date']; ?></p>
                                <p class="location">Location: <?= $event['event_venue']; ?></p>
                                <p class="location">Club: <?= $event['club_name']; ?></p>
                            </div>
                        </a>
                <?php
                    }
                } else {
                    echo '<p>No registered events yet.</p>';
                }
            ?>

            </div>

    </div>

<style>
    .section-container{
        display:flex;
        flex-direction:column;
        margin-left:80px;
        margin-top: 120px;
        background: rgba(242, 242, 242, 0.40);
    }

    .section-title {
            margin-bottom: 20px;
            padding-top:34px;
            padding-left:190px;
            color: var(--Black, #131315);
            font-family: Open Sans;
            font-size: 24px;
            font-style: normal;
            font-weight: 700;
            line-height: normal;
    }

    .event-container {
        display:flex;
        flex-wrap: wrap;
        justify-content: space-around;
    }

    .event-card {
            width: 300px;
            margin: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            float: left;
            background-color: white;
        }

    .event-card img{
   
    max-width: 100%;
    height: auto;
    border-radius: 6px;
    
    }

    .event-card .title{
        color:#1D294F;
        font-family: 'Open Sans', sans-serif;
        font-size: 24px;
        font-weight: 400;
        padding-top:15px;
    }

    .event-card .date{
        color: #1D86C5;
        font-size: 16px;
        font-weight: 400;
        font-family: 'Open Sans', sans-serif;

    }

    .event-card .location{
        color: #7E7E7E;
        font-size: 16px;
        font-weight: 400;
        font-family: 'Open Sans', sans-serif;
    }

    .event-card .btn{
       
       border-radius:10px;
       width: auto;
       margin:auto;
       margin-top:25px;
       background-color:#1D86C5;
       font-family: 'Open Sans', sans-serif;
       font-size: 16px;
       font-weight: 400;
       color: #fff;
       border: 2px solid #1D86C5;;
 
       
     

   }

   .btn {
    padding: 15px 25px 15px 25px;
    border-radius: 10px;
    width: 500px;
    margin: auto;
    margin-top: 25px;
    background-color: #1D86C5;
    font-family: 'Open Sans', sans-serif;
    font-size: 16px;
    font-weight: 400;
    color: #fff;
    border: 2px solid #1D86C5;
    margin-bottom: 30px;
}

</style>
