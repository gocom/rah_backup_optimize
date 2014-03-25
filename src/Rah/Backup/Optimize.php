<?php

/*
 * rah_backup_optimize - table optimizer module for rah_backup
 * https://github.com/gocom/rah_backup_optimize
 *
 * Copyright (C) 2014 Jukka Svahn
 *
 * This file is part of rah_backup_optimize.
 *
 * rah_backup_optimize is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation, version 2.
 *
 * rah_backup_optimize is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with rah_backup. If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Optimizes database tables after backups have been taken.
 */

class Rah_Backup_Optimize
{
    /**
     * Constructor.
     */

    public function __construct()
    {
        register_callback(array($this, 'optimizeTables'), 'rah_backup.created');
    }

    /**
     * Optimizes database tables.
     */

    public function optimizeTables()
    {
		if (@$tables = getThings('show tables')) {
            foreach ($tables as $table) {
                if (!PFX || strpos($table, PFX) === 0) {
			        @safe_query('optimize table `'.$table.'`');
                }
		    }
        }
    }
}

new Rah_Backup_Optimize();
