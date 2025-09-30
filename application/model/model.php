<?php

class Model
{
    /**
     * @param PDO $db A PDO database connection
     */
    public function __construct(PDO $db) // Updated to type hint PDO for better clarity
    {
        $this->db = $db; // Removed try-catch as PDO will throw exceptions on connection failure
    }

    /**
     * Get all songs from database
     */
    public function getAllSongs()
    {
        $sql = "SELECT id, artist, track, link FROM song";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ); // Specified fetch mode for clarity
    }

    /**
     * Add a song to database
     * @param string $artist Artist
     * @param string $track Track
     * @param string $link Link
     */
    public function addSong(string $artist, string $track, string $link) // Added type hints for parameters
    {
        $sql = "INSERT INTO song (artist, track, link) VALUES (:artist, :track, :link)";
        $query = $this->db->prepare($sql);
        $parameters = [':artist' => $artist, ':track' => $track, ':link' => $link]; // Modern array syntax

        $query->execute($parameters);
    }

    /**
     * Delete a song in the database
     * @param int $song_id Id of song
     */
    public function deleteSong(int $song_id) // Added type hint for parameter
    {
        $sql = "DELETE FROM song WHERE id = :song_id";
        $query = $this->db->prepare($sql);
        $parameters = [':song_id' => $song_id]; // Modern array syntax

        $query->execute($parameters);
    }

    /**
     * Get a song from database
     */
    public function getSong(int $song_id) // Added type hint for parameter
    {
        $sql = "SELECT id, artist, track, link FROM song WHERE id = :song_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = [':song_id' => $song_id]; // Modern array syntax

        $query->execute($parameters);

        return $query->fetch(PDO::FETCH_OBJ); // Specified fetch mode for clarity
    }

    /**
     * Update a song in database
     * @param string $artist Artist
     * @param string $track Track
     * @param string $link Link
     * @param int $song_id Id
     */
    public function updateSong(string $artist, string $track, string $link, int $song_id) // Added type hints for parameters
    {
        $sql = "UPDATE song SET artist = :artist, track = :track, link = :link WHERE id = :song_id";
        $query = $this->db->prepare($sql);
        $parameters = [':artist' => $artist, ':track' => $track, ':link' => $link, ':song_id' => $song_id]; // Modern array syntax

        $query->execute($parameters);
    }

    /**
     * Get simple "stats".
     */
    public function getAmountOfSongs()
    {
        $sql = "SELECT COUNT(id) AS amount_of_songs FROM song";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetch(PDO::FETCH_OBJ)->amount_of_songs; // Specified fetch mode for clarity
    }
}
