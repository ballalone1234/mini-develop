<?php

declare(strict_types=1);

/**
 * Class Songs
 * This is a demo class.
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Songs extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/songs/index
     */
    public function index(): void
    {
        // getting all songs and amount of songs
        $songs = $this->model->getAllSongs();
        $amount_of_songs = $this->model->getAmountOfSongs();

        // load views. within the views we can echo out $songs and $amount_of_songs easily
        require APP . 'view/_templates/header.php';
        require APP . 'view/songs/index.php';
        require APP . 'view/_templates/footer.php';
    }

    /**
     * ACTION: addSong
     * This method handles what happens when you move to http://yourproject/songs/addsong
     */
    public function addSong(): void
    {
        if (isset($_POST["submit_add_song"])) {
            $this->model->addSong($_POST["artist"], $_POST["track"], $_POST["link"]);
        }

        header('location: ' . URL . 'songs/index');
    }

    /**
     * ACTION: deleteSong
     * This method handles what happens when you move to http://yourproject/songs/deletesong
     */
    public function deleteSong(int $song_id): void
    {
        if (isset($song_id)) {
            $this->model->deleteSong($song_id);
        }

        header('location: ' . URL . 'songs/index');
    }

    /**
     * ACTION: editSong
     * This method handles what happens when you move to http://yourproject/songs/editsong
     */
    public function editSong(int $song_id): void
    {
        if (isset($song_id)) {
            $song = $this->model->getSong($song_id);

            require APP . 'view/_templates/header.php';
            require APP . 'view/songs/edit.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header('location: ' . URL . 'songs/index');
        }
    }

    /**
     * ACTION: updateSong
     * This method handles what happens when you move to http://yourproject/songs/updatesong
     */
    public function updateSong(): void
    {
        if (isset($_POST["submit_update_song"])) {
            $this->model->updateSong($_POST["artist"], $_POST["track"], $_POST["link"], $_POST['song_id']);
        }

        header('location: ' . URL . 'songs/index');
    }

    /**
     * AJAX-ACTION: ajaxGetStats
     */
    public function ajaxGetStats(): void
    {
        $amount_of_songs = $this->model->getAmountOfSongs();
        echo $amount_of_songs;
    }
}
