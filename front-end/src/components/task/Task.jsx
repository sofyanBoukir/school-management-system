import { StarIcon, CheckCircleIcon, ArrowTrendingUpIcon } from "@heroicons/react/24/outline";
import { useState } from "react";
import { editTaskStatus } from "../../services/taskService";
import { CircularProgress } from "@mui/material";
import { Notification } from "../UI/Notification";

export const Task = ({task}) => {

    const [status,setStatus] = useState(null);
    const [loading,setLoading] = useState(false);
    const [message,setMessage] = useState(null);

    const editTask = async () =>{
        const formData = new FormData();
        formData.append("status",status);
        formData.append("id",task.id);     
        console.log(formData);

        setLoading(true);        
        const response = await editTaskStatus(formData);
        console.log(response);
        
        setLoading(false);
        if(!response.data.updated){
            setMessage(response.data.message);
        }
        return response;
    }

    const handleCompletedTask = () =>{
        setStatus("completed");
        editTask();
    }

    const handleInProgressTask = () =>{
        setStatus("in progress");
        editTask();
    }

    return ( 
    <div className={`relative ${loading?"flex":null} justify-center items-center w-full lg:w-[21%] bg-white rounded-md p-3 h-52 cursor-pointer hover:bg-gray-200 duration-150 ease-in`}>
        {
            !loading ? 
                <>
                    <div>
                        <h1 className="text-xl font-semibold">{task.title}</h1>
                        <h3 className="text-sm text-gray-600 font-semibold">
                        {task.description}
                        </h3>
                    </div>
                    <div className="absolute flex justify-between items-center bottom-2 left-3 right-3">
                        <div>
                            <span className="text-gray-500 font-semibold text-sm">{task.due_date}</span>
                        </div>
                        <div>   
                            <span className="text-gray-500 font-semibold text-sm">{task.priority}</span>
                        </div>
                        <div className="flex gap-1">
                            <StarIcon className="w-6 h-6 text-gray-400 duration-150 ease-in-out hover:text-yellow-900"/>
                            <CheckCircleIcon className={`w-6 h-6 text-green-300 hover:text-green-900 ${task.status === 'completed'? 'text-green-800' :null} duration-150 ease-in-out`} onClick={() => handleCompletedTask()}/>
                            <ArrowTrendingUpIcon className={`w-6 h-6 text-blue-300 hover:text-blue-900 ${task.status === 'in progress'? 'text-blue-800' :null} duration-150 ease-in-out`} onClick={() => handleInProgressTask()}/>
                        </div>
                    </div>
                </>
            :
                <div className="flex">
                    <div>
                        <CircularProgress color="blue" size={"40px"} />
                    </div>
                </div>
        }
        {
            message && <Notification message={message} kind={"error"}/>
        }
    </div>
  )
}
