<?php

/*
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

return array(
    'operations' => array(
        'stats' => array(
            'httpMethod' => 'GET',
            'uri' => '?a=stats',
            'responseModel' => 'jsonResponse',
            'parameters' => array(
                'z' => array(
                    'type' => 'string',
                    'location' => 'query',
                ),
                'interval' => array(
                    'type' => 'integer',
                    'location' => 'query',
                ),
            ),
        ),
        'zoneLoadMulti' => array(
            'httpMethod' => 'GET',
            'uri' => '?a=zone_load_multi',
            'responseModel' => 'jsonResponse',
            'parameters' => array(
                // none
            ),
        ),
        'recLoadAll' => array(
            'httpMethod' => 'GET',
            'uri' => '?a=rec_load_all',
            'responseModel' => 'jsonResponse',
            'parameters' => array(
                'z' => array(
                    'type' => 'string',
                    'location' => 'query',
                ),
                'o' => array(
                    'type' => 'integer',
                    'location' => 'query',
                ),
            ),
        ),
        'zoneCheck' => array(
            'httpMethod' => 'GET',
            'uri' => '?a=zone_check',
            'responseModel' => 'jsonResponse',
            'parameters' => array(
                'zones' => array(
                    'type' => 'string',
                    'location' => 'query',
                ),
            ),
        ),
        'zoneIps' => array(
            'httpMethod' => 'GET',
            'uri' => '?a=zone_ips&geo=1',
            'responseModel' => 'jsonResponse',
            'parameters' => array(
                'z' => array(
                    'type' => 'string',
                    'location' => 'query',
                ),
                'hours' => array(
                    'type' => 'integer',
                    'location' => 'query',
                ),
                'class' => array(
                    'type' => 'string',
                    'location' => 'query',
                ),
            ),
        ),
        'ipLkup' => array(
            'httpMethod' => 'GET',
            'uri' => '?a=ip_lkup',
            'responseModel' => 'jsonResponse',
            'parameters' => array(
                'ip' => array(
                    'type' => 'string',
                    'location' => 'query',
                ),
            ),
        ),
        'zoneSettings' => array(
            'httpMethod' => 'GET',
            'uri' => '?a=zone_settings',
            'responseModel' => 'jsonResponse',
            'parameters' => array(
                'z' => array(
                    'type' => 'string',
                    'location' => 'query',
                ),
            ),
        ),
        'secLvl' => array(
            'httpMethod' => 'POST',
            'uri' => '?a=sec_lvl',
            'responseModel' => 'jsonResponse',
            'parameters' => array(
                'z' => array(
                    'type' => 'string',
                    'location' => 'query',
                ),
                'v' => array(
                    'type' => 'string',
                    'location' => 'query',
                ),
            ),
        ),
        'cacheLvl' => array(
            'httpMethod' => 'POST',
            'uri' => '?a=cache_lvl',
            'responseModel' => 'jsonResponse',
            'parameters' => array(
                'z' => array(
                    'type' => 'string',
                    'location' => 'query',
                ),
                'v' => array(
                    'type' => 'string',
                    'location' => 'query',
                ),
            ),
        ),
        'devMode' => array(
            'httpMethod' => 'POST',
            'uri' => '?a=devmode',
            'responseModel' => 'jsonResponse',
            'parameters' => array(
                'z' => array(
                    'type' => 'string',
                    'location' => 'query',
                ),
                'v' => array(
                    'type' => 'integer',
                    'location' => 'query',
                ),
            ),
        ),
        'fpurgeTs' => array(
            'httpMethod' => 'POST',
            'uri' => '?a=fpurge_ts&v=1',
            'responseModel' => 'jsonResponse',
            'parameters' => array(
                'z' => array(
                    'type' => 'string',
                    'location' => 'query',
                ),
            ),
        ),
        'zoneFilePurge' => array(
            'httpMethod' => 'POST',
            'uri' => '?a=zone_file_purge',
            'responseModel' => 'jsonResponse',
            'parameters' => array(
                'z' => array(
                    'type' => 'string',
                    'location' => 'query',
                ),
                'url' => array(
                    'type' => 'string',
                    'location' => 'query',
                ),
            ),
        ),
        'zoneGrab' => array(
            'httpMethod' => 'POST',
            'uri' => '?a=zone_grab',
            'responseModel' => 'jsonResponse',
            'parameters' => array(
                'zid' => array(
                    'type' => 'integer',
                    'location' => 'query',
                ),
            ),
        ),
        'wl' => array(
            'httpMethod' => 'POST',
            'uri' => '?a=wl',
            'responseModel' => 'jsonResponse',
            'parameters' => array(
                'key' => array(
                    'type' => 'string',
                    'location' => 'query',
                ),
            ),
        ),
        'ban' => array(
            'httpMethod' => 'POST',
            'uri' => '?a=ban',
            'responseModel' => 'jsonResponse',
            'parameters' => array(
                'key' => array(
                    'type' => 'string',
                    'location' => 'query',
                ),
            ),
        ),
        'nul' => array(
            'httpMethod' => 'POST',
            'uri' => '?a=nul',
            'responseModel' => 'jsonResponse',
            'parameters' => array(
                'key' => array(
                    'type' => 'string',
                    'location' => 'query',
                ),
            ),
        ),
        'ipv46' => array(
            'httpMethod' => 'POST',
            'uri' => '?a=ipv46',
            'responseModel' => 'jsonResponse',
            'parameters' => array(
                'z' => array(
                    'type' => 'string',
                    'location' => 'query',
                ),
                'v' => array(
                    'type' => 'integer',
                    'location' => 'query',
                ),
            ),
        ),
        'async' => array(
            'httpMethod' => 'POST',
            'uri' => '?a=async',
            'responseModel' => 'jsonResponse',
            'parameters' => array(
                'z' => array(
                    'type' => 'string',
                    'location' => 'query',
                ),
                'v' => array(
                    'type' => 'string',
                    'location' => 'query',
                ),
            ),
        ),
        'minify' => array(
            'httpMethod' => 'POST',
            'uri' => '?a=minify',
            'responseModel' => 'jsonResponse',
            'parameters' => array(
                'z' => array(
                    'type' => 'string',
                    'location' => 'query',
                ),
                'v' => array(
                    'type' => 'integer',
                    'location' => 'query',
                ),
            ),
        ),
        'mirage' => array(
            'httpMethod' => 'POST',
            'uri' => '?a=mirage2',
            'responseModel' => 'jsonResponse',
            'parameters' => array(
                'z' => array(
                    'type' => 'string',
                    'location' => 'query',
                ),
                'v' => array(
                    'type' => 'integer',
                    'location' => 'query',
                ),
            ),
        ),
        'recNew' => array(
            'httpMethod' => 'POST',
            'uri' => '?a=rec_new',
            'responseModel' => 'jsonResponse',
            'parameters' => array(
                'z' => array(
                    'type' => 'string',
                    'location' => 'query',
                ),
                'type' => array(
                    'type' => 'string',
                    'location' => 'query',
                ),
                'name' => array(
                    'type' => 'string',
                    'location' => 'query',
                ),
                'content' => array(
                    'type' => 'string',
                    'location' => 'query',
                ),
                'ttl' => array(
                    'type' => 'integer',
                    'location' => 'query',
                ),
                'prio' => array(
                    'type' => 'integer',
                    'location' => 'query',
                ),
                'service' => array(
                    'type' => 'string',
                    'location' => 'query',
                ),
                'srvname' => array(
                    'type' => 'string',
                    'location' => 'query',
                ),
                'protocol' => array(
                    'type' => 'string',
                    'location' => 'query',
                ),
                'weight' => array(
                    'type' => 'integer',
                    'location' => 'query',
                ),
                'port' => array(
                    'type' => 'integer',
                    'location' => 'query',
                ),
                'target' => array(
                    'type' => 'string',
                    'location' => 'query',
                ),
            ),
        ),
        'recEdit' => array(
            'httpMethod' => 'POST',
            'uri' => '?a=rec_edit',
            'responseModel' => 'jsonResponse',
            'parameters' => array(
                'z' => array(
                    'type' => 'string',
                    'location' => 'query',
                ),
                'type' => array(
                    'type' => 'string',
                    'location' => 'query',
                ),
                'id' => array(
                    'type' => 'integer',
                    'location' => 'query',
                ),
                'name' => array(
                    'type' => 'string',
                    'location' => 'query',
                ),
                'content' => array(
                    'type' => 'string',
                    'location' => 'query',
                ),
                'ttl' => array(
                    'type' => 'integer',
                    'location' => 'query',
                ),
                'prio' => array(
                    'type' => 'integer',
                    'location' => 'query',
                ),
                'service' => array(
                    'type' => 'string',
                    'location' => 'query',
                ),
                'srvname' => array(
                    'type' => 'string',
                    'location' => 'query',
                ),
                'protocol' => array(
                    'type' => 'string',
                    'location' => 'query',
                ),
                'weight' => array(
                    'type' => 'integer',
                    'location' => 'query',
                ),
                'port' => array(
                    'type' => 'integer',
                    'location' => 'query',
                ),
                'target' => array(
                    'type' => 'string',
                    'location' => 'query',
                ),
            ),
        ),
        'recDelete' => array(
            'httpMethod' => 'POST',
            'uri' => '?a=rec_delete',
            'responseModel' => 'jsonResponse',
            'parameters' => array(
                'z' => array(
                    'type' => 'string',
                    'location' => 'query',
                ),
                'id' => array(
                    'type' => 'integer',
                    'location' => 'query',
                ),
            ),
        ),
    ),
    'models' => array(
        'jsonResponse' => array(
            'type' => 'object',
            'additionalProperties' => array(
                'location' => 'json',
            ),
        ),
    ),
);
