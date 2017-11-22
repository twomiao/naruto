<?php
namespace Naruto;

use Naruto\Process;
use Naruto\ProcessException;

class Worker extends Process
{
	public function __construct($msg = '', $pid = 0, $type = 'worker')
	{
		$this->type = $type;
		$this->pid = $pid? : $this->pid;
		
		// log
		ProcessException::info([
			'msg' => [
				'from'  => $this->type,
				'extra' => 'worker instance create'
			]
		]);
		parent::__construct();
	}

	public function hangup()
	{
		while (true) {
			// handle pipe msg
			if ($msg = $this->pipeRead()) {
				var_dump($msg);
				$this->dispatchSig($msg);
			}


			// precent cpu usage rate reach 100%
			sleep(self::LOOP_SLEEP_TIME);
		}
	}

	private function dispatchSig()
	{
		
	}
}
