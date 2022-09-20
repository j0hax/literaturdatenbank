<?php

// Compare two publications by name, author, and date
function attrsort($a, $b): int
{
    return ($b->date <=> $a->date) * 1000 + // date descending, then
    ($a->title <=> $b->title) * 100 + // title ascending, then
    ($a->author <=> $b->author) * 10; // author ascending
}
