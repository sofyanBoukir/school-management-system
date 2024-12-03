import { useEffect } from "react"
import { Header } from "../../components/layout/Header"
import { Profile } from "../../components/layout/Profile"
import { SideBar } from "../../components/layout/SideBar"
import { LinearLoading } from "../../components/UI/LinearLoading"
import { useDispatch, useSelector } from "react-redux"
import { fetchProjects } from "../../redux/action/projectsActions"

export const ProjectsWith = () => {
    const dispatch = useDispatch();

  const { projects, loading, error } = useSelector((state) => state.projects);

    useEffect(() => {
        const token = localStorage.getItem("token");
        if (token) {
        dispatch(fetchProjects(token));
        }
    }, [dispatch]);        
    
  return (
    <div className="flex">
      <SideBar />
      <div className="flex-1">
        <Header />
        <div className="ml-16 w-[85%] p-3 mt-14">
          <div>
            <h1 className="text-2xl font-semibold">Projects I am with</h1>
          </div>
          {
            loading && <div className="mt-2">
              <LinearLoading />
            </div>
          }
          <div className="flex gap-4 mt-5 flex-wrap">
            {/* {
              savedTasks && savedTasks.length ?
              savedTasks.map((task) =>{
                  return <Task task={task}/>
                })
              :null
            }
            {
              loading === false && savedTasks.length === 0 && <span className="text-xl">No tasks saved!</span>
            } */}
          </div>
        </div>
      </div>
      <Profile />
    </div>
  )
}