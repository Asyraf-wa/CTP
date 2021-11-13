<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Event\EventInterface;

class SettingsController extends AppController
{
    public function update($id = null)
    {
        $setting = $this->Settings->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $setting = $this->Settings->patchEntity($setting, $this->request->getData());
            if ($this->Settings->save($setting)) {
                $this->Flash->success(__('The setting has been saved.'));

                return $this->redirect($this->referer());
            }
            $this->Flash->error(__('The setting could not be saved. Please, try again.'));
        }
        $this->set(compact('setting'));
    }

	public function cakelog($filename=null) {
		$fullpath = LOGS;

		if($this->getRequest()->isPost()) {
			$formdata = $this->getRequest()->getData();

			$fp = fopen($fullpath.$filename, "w");
			fwrite($fp, $formdata['UserSettings']['logfile']);
			fclose($fp);

			$this->Flash->success(__('{0} has been modified successfully', [$filename]));
			$this->redirect(['action'=>'cakelog']);
		}

		$logFiles = glob($fullpath."*.log");

		$this->set(compact('logFiles', 'filename'));
	}

	public function cakelogbackup($filename=null) {
		if($this->getRequest()->isPost()) {
			if(!empty($filename)) {
				$filepath = LOGS.$filename;

				if(file_exists($filepath)) {
					$pathinfo = pathinfo($filepath);
					$newfile = $pathinfo['filename'].'_'.date('d-M-Y_H-i', time()).'.'.$pathinfo['extension'];

					if(copy($filepath, LOGS.$newfile)) {
						$this->Flash->success(__('{0} has been copied to {1}', [$filename, $newfile]));
					} else {
						$this->Flash->error(__('{0} file could not be copied', [$filename]));
					}
				} else {
					$this->Flash->warning(__('{0} file does not exist', [$filename]));
				}
			} else {
				$this->Flash->error(__('Missing Filename'));
			}
		}

		$this->redirect(['action'=>'cakelog']);
	}

	public function cakelogdelete($filename=null) {
		if($this->getRequest()->isPost()) {
			if(!empty($filename)) {
				$filepath = LOGS.$filename;

				if(file_exists($filepath)) {
					if(unlink($filepath)) {
						$this->Flash->success(__('{0} has been deleted successfully', [$filename]));
					} else {
						$this->Flash->error(__('{0} file could not be deleted', [$filename]));
					}
				} else {
					$this->Flash->warning(__('{0} file does not exist', [$filename]));
				}
			} else {
				$this->Flash->error(__('Missing Filename'));
			}
		}

		$this->redirect(['action'=>'cakelog']);
	}

	public function cakelogempty($filename=null) {
		if($this->getRequest()->isPost()) {
			if(!empty($filename)) {
				$filepath = LOGS.$filename;
				$f = @fopen($filepath, "r+");

				if($f !== false) {
					ftruncate($f, 0);
					fclose($f);

					$this->Flash->success(__('{0} has been emptied', [$filename]));
				} else {
					$this->Flash->warning(__('{0} file does not exist', [$filename]));
				}
			} else {
				$this->Flash->error(__('Missing Filename'));
			}
		}

		$this->redirect(['action'=>'cakelog']);
	}	
	
	public function clearCache(){
		//\Cake\Cache\Cache::clear(true);
		//die('Cache cleared.');
		Cache::clear();
	}
}
