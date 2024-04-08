API ENDPOINTS
-------------

### Workers

http://localhost:8080/workers (POST) - Create new worker, in body you should include:

    {

        "firstname": string,
    
        "lastname": string
    
    }

http://localhost:8080/workers (GET) - Get all workers

http://localhost:8080/workers/{id} (GET) - Get worker with specified id

http://localhost:8080/workers/{id} (PUT) - Update worker with id, in body you should include:

    {
    
        "firstname": string,
        
        "lastname": string
        
    }

http://localhost:8080/workers/{id} (DELETE) - Delete worker

### Meetings

http://localhost:8080/meetings (POST) - Create new meeting, in body you should include:

    {
    
        "date": "hhhh.mm.dd",
        
        "start_time": "hh:mm",
        
        "end_time": "hh:mm"
        
    }

http://localhost:8080/meetings (GET) - Get all meetings

http://localhost:8080/meetings/{id} (GET) - Get meeting with specified id

http://localhost:8080/meetings/{id} (PUT) - Update meeting with id, in body you should include:

    {
    
        "date": "hhhh.mm.dd",
        
        "start_time": "hh:mm",
        
        "end_time": "hh:mm"
        
    }

http://localhost:8080/meetings/{id} (DELETE) - Delete meeting

### WorkerMeetings

http://localhost:8080/worker-meetings (POST) - Create new relation between worker and meeting, in body you should include:

    {
    
        "worker_id": int,
        
        "meeting_id": int
        
    }

http://localhost:8080/worker-meetings (GET) - Get all worker-meeting relations

http://localhost:8080/worker-meetings/{id} (GET) - Get worker-meeting relation with specified id

http://localhost:8080/worker-meetings/{id} (PUT) - Update worker-meeting relation with id, in body you should include:
    
    {
    
        "worker_id": int,
        
        "meeting_id": int
        
    }

http://localhost:8080/worker-meetings/{id} (DELETE) - Delete worker-meeting relation

### ScheduleManager

http://localhost:8080/schedule-manager?workerId={id}&date={yyyy-mm-dd} (GET) - Make optimal schedule for worker at specified date
