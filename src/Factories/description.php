<?php

/**
 * This file is part of Laravel CloudFlare API by Graham Campbell.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at http://bit.ly/UWsjkb.
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

return [
    'operations' => [
        'stats' => [
            'httpMethod' => 'GET',
            'uri' => '?a=stats',
            'responseModel' => 'jsonResponse',
            'parameters' => [
                'z' => [
                    'type' => 'string',
                    'location' => 'query',
                ],
                'interval' => [
                    'type' => 'integer',
                    'location' => 'query',
                ],
            ],
        ],
        'zoneLoadMulti' => [
            'httpMethod' => 'GET',
            'uri' => '?a=zone_load_multi',
            'responseModel' => 'jsonResponse',
            'parameters' => [
                // none
            ],
        ],
        'recLoadAll' => [
            'httpMethod' => 'GET',
            'uri' => '?a=rec_load_all',
            'responseModel' => 'jsonResponse',
            'parameters' => [
                'z' => [
                    'type' => 'string',
                    'location' => 'query',
                ],
                'o' => [
                    'type' => 'integer',
                    'location' => 'query',
                ],
            ],
        ],
        'zoneCheck' => [
            'httpMethod' => 'GET',
            'uri' => '?a=zone_check',
            'responseModel' => 'jsonResponse',
            'parameters' => [
                'zones' => [
                    'type' => 'string',
                    'location' => 'query',
                ],
            ],
        ],
        'zoneIps' => [
            'httpMethod' => 'GET',
            'uri' => '?a=zone_ips&geo=1',
            'responseModel' => 'jsonResponse',
            'parameters' => [
                'z' => [
                    'type' => 'string',
                    'location' => 'query',
                ],
                'hours' => [
                    'type' => 'integer',
                    'location' => 'query',
                ],
                'class' => [
                    'type' => 'string',
                    'location' => 'query',
                ],
            ],
        ],
        'ipLkup' => [
            'httpMethod' => 'GET',
            'uri' => '?a=ip_lkup',
            'responseModel' => 'jsonResponse',
            'parameters' => [
                'ip' => [
                    'type' => 'string',
                    'location' => 'query',
                ],
            ],
        ],
        'zoneSettings' => [
            'httpMethod' => 'GET',
            'uri' => '?a=zone_settings',
            'responseModel' => 'jsonResponse',
            'parameters' => [
                'z' => [
                    'type' => 'string',
                    'location' => 'query',
                ],
            ],
        ],
        'secLvl' => [
            'httpMethod' => 'POST',
            'uri' => '?a=sec_lvl',
            'responseModel' => 'jsonResponse',
            'parameters' => [
                'z' => [
                    'type' => 'string',
                    'location' => 'query',
                ],
                'v' => [
                    'type' => 'string',
                    'location' => 'query',
                ],
            ],
        ],
        'cacheLvl' => [
            'httpMethod' => 'POST',
            'uri' => '?a=cache_lvl',
            'responseModel' => 'jsonResponse',
            'parameters' => [
                'z' => [
                    'type' => 'string',
                    'location' => 'query',
                ],
                'v' => [
                    'type' => 'string',
                    'location' => 'query',
                ],
            ],
        ],
        'devMode' => [
            'httpMethod' => 'POST',
            'uri' => '?a=devmode',
            'responseModel' => 'jsonResponse',
            'parameters' => [
                'z' => [
                    'type' => 'string',
                    'location' => 'query',
                ],
                'v' => [
                    'type' => 'integer',
                    'location' => 'query',
                ],
            ],
        ],
        'fpurgeTs' => [
            'httpMethod' => 'POST',
            'uri' => '?a=fpurge_ts&v=1',
            'responseModel' => 'jsonResponse',
            'parameters' => [
                'z' => [
                    'type' => 'string',
                    'location' => 'query',
                ],
            ],
        ],
        'zoneFilePurge' => [
            'httpMethod' => 'POST',
            'uri' => '?a=zone_file_purge',
            'responseModel' => 'jsonResponse',
            'parameters' => [
                'z' => [
                    'type' => 'string',
                    'location' => 'query',
                ],
                'url' => [
                    'type' => 'string',
                    'location' => 'query',
                ],
            ],
        ],
        'zoneGrab' => [
            'httpMethod' => 'POST',
            'uri' => '?a=zone_grab',
            'responseModel' => 'jsonResponse',
            'parameters' => [
                'zid' => [
                    'type' => 'integer',
                    'location' => 'query',
                ],
            ],
        ],
        'wl' => [
            'httpMethod' => 'POST',
            'uri' => '?a=wl',
            'responseModel' => 'jsonResponse',
            'parameters' => [
                'key' => [
                    'type' => 'string',
                    'location' => 'query',
                ],
            ],
        ],
        'ban' => [
            'httpMethod' => 'POST',
            'uri' => '?a=ban',
            'responseModel' => 'jsonResponse',
            'parameters' => [
                'key' => [
                    'type' => 'string',
                    'location' => 'query',
                ],
            ],
        ],
        'nul' => [
            'httpMethod' => 'POST',
            'uri' => '?a=nul',
            'responseModel' => 'jsonResponse',
            'parameters' => [
                'key' => [
                    'type' => 'string',
                    'location' => 'query',
                ],
            ],
        ],
        'ipv46' => [
            'httpMethod' => 'POST',
            'uri' => '?a=ipv46',
            'responseModel' => 'jsonResponse',
            'parameters' => [
                'z' => [
                    'type' => 'string',
                    'location' => 'query',
                ],
                'v' => [
                    'type' => 'integer',
                    'location' => 'query',
                ],
            ],
        ],
        'async' => [
            'httpMethod' => 'POST',
            'uri' => '?a=async',
            'responseModel' => 'jsonResponse',
            'parameters' => [
                'z' => [
                    'type' => 'string',
                    'location' => 'query',
                ],
                'v' => [
                    'type' => 'string',
                    'location' => 'query',
                ],
            ],
        ],
        'minify' => [
            'httpMethod' => 'POST',
            'uri' => '?a=minify',
            'responseModel' => 'jsonResponse',
            'parameters' => [
                'z' => [
                    'type' => 'string',
                    'location' => 'query',
                ],
                'v' => [
                    'type' => 'integer',
                    'location' => 'query',
                ],
            ],
        ],
        'mirage' => [
            'httpMethod' => 'POST',
            'uri' => '?a=mirage2',
            'responseModel' => 'jsonResponse',
            'parameters' => [
                'z' => [
                    'type' => 'string',
                    'location' => 'query',
                ],
                'v' => [
                    'type' => 'integer',
                    'location' => 'query',
                ],
            ],
        ],
        'recNew' => [
            'httpMethod' => 'POST',
            'uri' => '?a=rec_new',
            'responseModel' => 'jsonResponse',
            'parameters' => [
                'z' => [
                    'type' => 'string',
                    'location' => 'query',
                ],
                'type' => [
                    'type' => 'string',
                    'location' => 'query',
                ],
                'name' => [
                    'type' => 'string',
                    'location' => 'query',
                ],
                'content' => [
                    'type' => 'string',
                    'location' => 'query',
                ],
                'ttl' => [
                    'type' => 'integer',
                    'location' => 'query',
                ],
                'prio' => [
                    'type' => 'integer',
                    'location' => 'query',
                ],
                'service' => [
                    'type' => 'string',
                    'location' => 'query',
                ],
                'srvname' => [
                    'type' => 'string',
                    'location' => 'query',
                ],
                'protocol' => [
                    'type' => 'string',
                    'location' => 'query',
                ],
                'weight' => [
                    'type' => 'integer',
                    'location' => 'query',
                ],
                'port' => [
                    'type' => 'integer',
                    'location' => 'query',
                ],
                'target' => [
                    'type' => 'string',
                    'location' => 'query',
                ],
            ],
        ],
        'recEdit' => [
            'httpMethod' => 'POST',
            'uri' => '?a=rec_edit',
            'responseModel' => 'jsonResponse',
            'parameters' => [
                'z' => [
                    'type' => 'string',
                    'location' => 'query',
                ],
                'type' => [
                    'type' => 'string',
                    'location' => 'query',
                ],
                'id' => [
                    'type' => 'integer',
                    'location' => 'query',
                ],
                'name' => [
                    'type' => 'string',
                    'location' => 'query',
                ],
                'content' => [
                    'type' => 'string',
                    'location' => 'query',
                ],
                'ttl' => [
                    'type' => 'integer',
                    'location' => 'query',
                ],
                'prio' => [
                    'type' => 'integer',
                    'location' => 'query',
                ],
                'service' => [
                    'type' => 'string',
                    'location' => 'query',
                ],
                'srvname' => [
                    'type' => 'string',
                    'location' => 'query',
                ],
                'protocol' => [
                    'type' => 'string',
                    'location' => 'query',
                ],
                'weight' => [
                    'type' => 'integer',
                    'location' => 'query',
                ],
                'port' => [
                    'type' => 'integer',
                    'location' => 'query',
                ],
                'target' => [
                    'type' => 'string',
                    'location' => 'query',
                ],
            ],
        ],
        'recDelete' => [
            'httpMethod' => 'POST',
            'uri' => '?a=rec_delete',
            'responseModel' => 'jsonResponse',
            'parameters' => [
                'z' => [
                    'type' => 'string',
                    'location' => 'query',
                ],
                'id' => [
                    'type' => 'integer',
                    'location' => 'query',
                ],
            ],
        ],
    ],
    'models' => [
        'jsonResponse' => [
            'type' => 'object',
            'additionalProperties' => [
                'location' => 'json',
            ],
        ],
    ],
];
