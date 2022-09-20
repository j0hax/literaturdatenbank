<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use PHPOnCouch\CouchClient;

function get_uri()
{
    $dbhost = getenv("COUCHDB_HOST");
    $user = getenv("COUCHDB_USER");
    $pass = getenv("COUCHDB_PASSWORD");

    return "http://$user:$pass@$dbhost:5984";
}

function get_db()
{

    $client = new CouchClient(get_uri(), 'literaturdatenbank');
    if (!$client->databaseExists()) {
        $client->createDatabase();
    }

    return $client;
}

// Types of Documents supported by BibTex
const DOC_TYPES = ['article' => 'Artikel', 'book' => 'Buch', 'booklet' => 'Heft/Brochüre', 'inproceedings' => 'Vortrag', 'manual' => 'Handbuch', 'masterthesis' => 'Masterarbeit', 'misc' => 'Verschiedenes', 'phdthesis' => 'Doktorarbeit', 'proceedings' => 'Tagung', 'techreport' => 'Technischer Bericht', 'unpublished' => 'Unveröffentlicht'];
