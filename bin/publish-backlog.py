#!/usr/bin/env python3
"""Publish the prepared backlog via authenticated gh. Explicit --publish required."""
import argparse,json,subprocess,time
from pathlib import Path
p=argparse.ArgumentParser();p.add_argument('--publish',action='store_true');p.add_argument('--repo',default='amoncif/pam-mock-server');args=p.parse_args()
r=Path(__file__).resolve().parent.parent;items=json.loads((r/'docs/backlog.json').read_text())
if not args.publish:print(f'{len(items)} issues prepared. Pass --publish to write to GitHub.');raise SystemExit()
def api(path,payload=None):
 command=['gh','api',path]
 if payload is not None:command+=['--method','POST','--input','-']
 for attempt in range(8):
  result=subprocess.run(command,input=json.dumps(payload) if payload is not None else None,text=True,capture_output=True)
  if result.returncode==0:return json.loads(result.stdout) if result.stdout.strip() else None
  if 'secondary rate' in result.stderr.lower() or 'rate limit' in result.stderr.lower():time.sleep(45);continue
  raise RuntimeError(result.stderr)
 raise RuntimeError('GitHub rate limit did not clear; rerun safely later.')
base='repos/'+args.repo
existing=[];page=1
while True:
 page_items=api(base+f'/issues?state=all&per_page=100&page={page}')
 if not page_items:break
 existing+=page_items;page+=1
labels=['epic','user-story','authentication','accounts','safes','platforms','users','groups','psm','sessions','recordings','requests','documentation','compatibility','testing','good-first-issue']
current={x['name'] for x in api(base+'/labels?per_page=100')}
for label in labels:
 if label not in current:api(base+'/labels',{'name':label,'color':'356A8A','description':'PAM Mock Server '+label});time.sleep(1)
ms=api(base+'/milestones?state=all');milestone=next((x['number'] for x in ms if x['title']=='v0.1 - PAM API Foundation'),None)
if milestone is None:milestone=api(base+'/milestones',{'title':'v0.1 - PAM API Foundation','description':'Sourced API inventory, runnable foundation and local authentication contracts.'})['number']
index=[]
for i,item in enumerate(items):
 marker='<!-- pam-backlog:'+item['key']+' -->';found=next((x for x in existing if marker in (x.get('body') or '')),None)
 if found is None:
  payload={k:item[k] for k in ['title','body','labels']}
  if item['milestone']:payload['milestone']=milestone
  found=api(base+'/issues',payload);time.sleep(1.2)
 index.append({'key':item['key'],'number':found['number'],'url':found['html_url']})
 (r/'docs/github-issues.json').write_text(json.dumps(index,indent=2)+'\n')
 if (i+1)%25==0:print(f'{i+1}/{len(items)} issues synchronized',flush=True)
print(f'Completed: {len(index)} issues; milestone #{milestone}',flush=True)
