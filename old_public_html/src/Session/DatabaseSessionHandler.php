<?php

namespace Eclair\Session;

use Eclair\Database\Adaptor;

class DatabaseSessionHandler implements  \SessionHandlerInterface
{
    public function open($savePath, $sessionName): bool
    {
        return true;
    }

    public function close(): bool
    {
        // TODO: Implement close() method.
        return true;
    }

    public function read(string $id): string|false
    {
        $data = current(Adaptor::getAll('select * from sessions where `id` = ?', [ $id ]));

        if ($data) {
            $payload = $data->payload;
        }else {

            Adaptor::exec('insert into sessions(`id`) values(?)', [ $id ]);
        }
        return $payload ?? '';
    }

    #[\ReturnTypeWillChange]
    public function write($id, $payload)
    {
        return Adaptor::exec('update sessions set `payload` = ? where `id` = ?', [ $payload, $id ]);
    }

    #[\ReturnTypeWillChange]
    public function destroy(string $id)
    {
        return Adaptor::exec('delete from sessions where `id` =?', [ $id ]);
    }

    #[\ReturnTypeWillChange]
    public function gc($maxlifetime)
    {
        if ($sessions = Adaptor::getAll('select * from sessions')) {
            foreach ($sessions as $session) {
                $timestamp = strtotime($session->created_at);
                if (time() - $timestamp > $maxlifetime) {
                    $this->destroy($session->id);
                }
            }
            return true;
        }
        return false;
    }
}