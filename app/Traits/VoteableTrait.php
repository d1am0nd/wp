<?php

namespace App\Traits;

use Auth;
use App\Vote;

trait VoteableTrait
{
    public function votes()
    {
        return $this->morphMany('App\Vote', 'voteable');
    }

    // Vote: -1 | 0 | 1
    // Return: newVote - previousVote
    public function vote($vote)
    {
        $vote = (int)$vote;
        if($vote !== -1 && $vote !== 1)
            return 'Error voting';

        $dbVote = Vote::where('user_id', Auth::user()->id)
            ->where('voteable_id', $this->id)
            ->where('voteable_type', $this->getMorphClass())
            ->first();

        if(!$dbVote)
            $dbVote = new Vote;
        elseif($dbVote->vote == $vote){
            // If vote is same as last vote, we delete the vote (put vote on 0)
            $dbVote->delete();
            // Return negative of last vote
            return $vote*(-1);
        }
        // Return new vote - last vote
        $return = $vote - $dbVote->vote;

        $dbVote->user_id = Auth::user()->id;
        $dbVote->voteable_id = $this->id;
        $dbVote->voteable_type = $this->getMorphClass();
        $dbVote->vote = $vote;
        $dbVote->save();

        return $return;
    }

    public function scopeWithVotesOrder($query, $order = 'DESC')
    {
        return $this->scopeWithVotes($query)->orderBy('votes', $order);
    }

    public function scopeWithVotes($query)
    {
        // Example: 'App\Page'
        $model = get_class();
        // Example: 'pages'
        $table = $this->getTable();

        // Add votes column to the query with sum of all votes on the item
        $query->leftJoin('votes', function($join) use($model, $table)
        {
            $join->on('votes.voteable_id', '=', $table . '.id')
                ->where('votes.voteable_type', '=', $model);
        })
        ->addSelect('*', $table . '.id', \DB::raw('COALESCE(SUM(votes.vote),0) as votes'))
        ->groupBy($table . '.id');

        // Add my_vote column to the query with user's vote on the imte
        if(Auth::check()){
            $query->leftJoin('votes as my_vote', function($join) use($model, $table)
            {
                $join->on('my_vote.voteable_id', '=', $table . '.id')
                    ->where('my_vote.voteable_type', '=', $model)
                    ->where('my_vote.user_id', '=', Auth::user()->id);
            })->addSelect('my_vote.vote as my_vote');
        }
        return $query;
    }
}
