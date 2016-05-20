alter table `daemon` add `memory` integer not null default 0;
alter table `daemon` add `ftp_ip` text not null default '';
alter table `daemon` add `ftp_port` integer not null default 21;
create index `idx_cmd_chat` on `command`(`chat`);
create index `idx_cmd_name` on `command`(`name`);
create index `idx_dmn_token` on `daemon`(`token`);
create index `idx_fus_name` on `ftp_user`(`name`);
create index `idx_sch_server_id` on `schedule`(`server_id`);
create index `idx_sch_scheduled_ts` on `schedule`(`scheduled_ts`);
create index `idx_sch_status` on `schedule`(`status`);
create index `idx_srv_daemon_id` on `server`(`daemon_id`);
create index `idx_srv_suspended` on `server`(`suspended`);
