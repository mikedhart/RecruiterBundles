<?php

namespace Recruiter\EmployerBundle\Services;

use Recruiter\UserBundle\Services\Handler as UserHandler;
use Doctrine\ORM\Query;

class SearchHandler extends UserHandler
{	
	/**
	 * Holds the query to be executed.
	 * 
	 * @var Query
	 */
	private $query;
	
	/**
	 * Gets a preconfigured query builder.
	 * 
	 * @return \Doctrine\ORM\QueryBuilder
	 */
	private function getInitialisedQueryBuilder()
	{
		$qb = $this->em->createQueryBuilder()
			->add("select", "r")
			->add("from", "RecruiterRecruitBundle:Recruit r")
		;
		
		return $qb;
	}
	
	/**
	 * @param Query $query
	 */
	public function setQuery(Query $query)
	{
		$this->query = $query;
	}
	
	/**
	 * @return \Doctrine\ORM\Query
	 */
	public function getQuery()
	{
		return $this->query;
	}
	
	public function buildQuery($searchParams = array(), $set = true)
	{
		$qb = $this->getInitialisedQueryBuilder();
		
		if (isset($searchParams["skill"])) {
			$qb->leftJoin("r.skills", "s");
			//$qb->add("where", "s in (:skills)");
			//$qb->setParameter("skills", implode(",", array_keys($searchParams["skill"])));
			$qb->andWhere($qb->expr()->in("s", array_keys($searchParams["skill"])));
		}
		
		if (isset($searchParams["job_type"])) {
			$qb->leftJoin("r.job_types", "j");
			//$qb->add("where", "j in (:jobTypes)");
			//$qb->setParameter("jobTypes", implode(",", array_keys($searchParams["job_type"])));
			$qb->andWhere($qb->expr()->in("j", array_keys($searchParams["job_type"])));
		}
		
		if ($searchParams["location"] !== "null") {
			$qb->andWhere("r.location = :location");
			$qb->setParameter("location", $searchParams["location"]);
		}
		
		if (isset($searchParams["job_title"])) {
			if (strlen($searchParams["job_title"]) > 0) {
				$qb->andWhere("r.recruit_job_title like '%" . $searchParams["job_title"] . "%'");
			}
		}
		
		if ($set === true) {
			$this->setQuery($qb->getQuery());
		}
		
		return $qb->getQuery();
	}
	
	public function run()
	{
		return $this->query->getResult();
	}
}