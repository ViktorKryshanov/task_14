<?php

    interface EventListenerInterface
    {
        public function attachEvent($method_name);
        public function detouchEvent($method_name);
    }

